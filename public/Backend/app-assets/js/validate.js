/*!
 * jQuery Validation Plugin v1.19.3
 *
 * https://jqueryvalidation.org/
 *
 * Copyright (c) 2021 Jörn Zaefferer
 * Released under the MIT license
 */
(function( factory ) {
    if ( typeof define === "function" && define.amd ) {
        define( ["jquery"], factory );
    } else if (typeof module === "object" && module.exports) {
        module.exports = factory( require( "jquery" ) );
    } else {
        factory( jQuery );
    }
}(function( $ ) {

$.extend( $.fn, {

    // https://jqueryvalidation.org/validate/
    validate: function( options ) {

        // If nothing is selected, return nothing; can't chain anyway
        if ( !this.length ) {
            if ( options && options.debug && window.console ) {
                console.warn( "Nothing selected, can't validate, returning nothing." );
            }
            return;
        }

        // Check if a validator for this form was already created
        var validator = $.data( this[ 0 ], "validator" );
        if ( validator ) {
            return validator;
        }

        // Add novalidate tag if HTML5.
        this.attr( "novalidate", "novalidate" );

        validator = new $.validator( options, this[ 0 ] );
        $.data( this[ 0 ], "validator", validator );

        if ( validator.settings.onsubmit ) {

            this.on( "click.validate", ":submit", function( event ) {

                // Track the used submit button to properly handle scripted
                // submits later.
                validator.submitButton = event.currentTarget;

                // Allow suppressing validation by adding a cancel class to the submit button
                if ( $( this ).hasClass( "cancel" ) ) {
                    validator.cancelSubmit = true;
                }

                // Allow suppressing validation by adding the html5 formnovalidate attribute to the submit button
                if ( $( this ).attr( "formnovalidate" ) !== undefined ) {
                    validator.cancelSubmit = true;
                }
            } );

            // Validate the form on submit
            this.on( "submit.validate", function( event ) {
                if ( validator.settings.debug ) {

                    // Prevent form submit to be able to see console output
                    event.preventDefault();
                }

                function handle() {
                    var hidden, result;

                    // Insert a hidden input as a replacement for the missing submit button
                    // The hidden input is inserted in two cases:
                    //   - A user defined a `submitHandler`
                    //   - There was a pending request due to `remote` method and `stopRequest()`
                    //     was called to submit the form in case it's valid
                    if ( validator.submitButton && ( validator.settings.submitHandler || validator.formSubmitted ) ) {
                        hidden = $( "<input type='hidden'/>" )
                            .attr( "name", validator.submitButton.name )
                            .val( $( validator.submitButton ).val() )
                            .appendTo( validator.currentForm );
                    }

                    if ( validator.settings.submitHandler && !validator.settings.debug ) {
                        result = validator.settings.submitHandler.call( validator, validator.currentForm, event );
                        if ( hidden ) {

                            // And clean up afterwards; thanks to no-block-scope, hidden can be referenced
                            hidden.remove();
                        }
                        if ( result !== undefined ) {
                            return result;
                        }
                        return false;
                    }
                    return true;
                }

                // Prevent submit for invalid forms or custom submit handlers
                if ( validator.cancelSubmit ) {
                    validator.cancelSubmit = false;
                    return handle();
                }
                if ( validator.form() ) {
                    if ( validator.pendingRequest ) {
                        validator.formSubmitted = true;
                        return false;
                    }
                    return handle();
                } else {
                    validator.focusInvalid();
                    return false;
                }
            } );
        }

        return validator;
    },

    // https://jqueryvalidation.org/valid/
    valid: function() {
        var valid, validator, errorList;

        if ( $( this[ 0 ] ).is( "form" ) ) {
            valid = this.validate().form();
        } else {
            errorList = [];
            valid = true;
            validator = $( this[ 0 ].form ).validate();
            this.each( function() {
                valid = validator.element( this ) && valid;
                if ( !valid ) {
                    errorList = errorList.concat( validator.errorList );
                }
            } );
            validator.errorList = errorList;
        }
        return valid;
    },

    // https://jqueryvalidation.org/rules/
    rules: function( command, argument ) {
        var element = this[ 0 ],
            isContentEditable = typeof this.attr( "contenteditable" ) !== "undefined" && this.attr( "contenteditable" ) !== "false",
            settings, staticRules, existingRules, data, param, filtered;

        // If nothing is selected, return empty object; can't chain anyway
        if ( element == null ) {
            return;
        }

        if ( !element.form && isContentEditable ) {
            element.form = this.closest( "form" )[ 0 ];
            element.name = this.attr( "name" );
        }

        if ( element.form == null ) {
            return;
        }

        if ( command ) {
            settings = $.data( element.form, "validator" ).settings;
            staticRules = settings.rules;
            existingRules = $.validator.staticRules( element );
            switch ( command ) {
            case "add":
                $.extend( existingRules, $.validator.normalizeRule( argument ) );

                // Remove messages from rules, but allow them to be set separately
                delete existingRules.messages;
                staticRules[ element.name ] = existingRules;
                if ( argument.messages ) {
                    settings.messages[ element.name ] = $.extend( settings.messages[ element.name ], argument.messages );
                }
                break;
            case "remove":
                if ( !argument ) {
                    delete staticRules[ element.name ];
                    return existingRules;
                }
                filtered = {};
                $.each( argument.split( /\s/ ), function( index, method ) {
                    filtered[ method ] = existingRules[ method ];
                    delete existingRules[ method ];
                } );
                return filtered;
            }
        }

        data = $.validator.normalizeRules(
        $.extend(
            {},
            $.validator.classRules( element ),
            $.validator.attributeRules( element ),
            $.validator.dataRules( element ),
            $.validator.staticRules( element )
        ), element );

        // Make sure required is at front
        if ( data.required ) {
            param = data.required;
            delete data.required;
            data = $.extend( { required: param }, data );
        }

        // Make sure remote is at back
        if ( data.remote ) {
            param = data.remote;
            delete data.remote;
            data = $.extend( data, { remote: param } );
        }

        return data;
    }
} );

// JQuery trim is deprecated, provide a trim method based on String.prototype.trim
var trim = function( str ) {

    // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/trim#Polyfill
    return str.replace( /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, "" );
};

// Custom selectors
$.extend( $.expr.pseudos || $.expr[ ":" ], {        // '|| $.expr[ ":" ]' here enables backwards compatibility to jQuery 1.7. Can be removed when dropping jQ 1.7.x support

    // https://jqueryvalidation.org/blank-selector/
    blank: function( a ) {
        return !trim( "" + $( a ).val() );
    },

    // https://jqueryvalidation.org/filled-selector/
    filled: function( a ) {
        var val = $( a ).val();
        return val !== null && !!trim( "" + val );
    },

    // https://jqueryvalidation.org/unchecked-selector/
    unchecked: function( a ) {
        return !$( a ).prop( "checked" );
    }
} );

// Constructor for validator
$.validator = function( options, form ) {
    this.settings = $.extend( true, {}, $.validator.defaults, options );
    this.currentForm = form;
    this.init();
};

// https://jqueryvalidation.org/jQuery.validator.format/
$.validator.format = function( source, params ) {
    if ( arguments.length === 1 ) {
        return function() {
            var args = $.makeArray( arguments );
            args.unshift( source );
            return $.validator.format.apply( this, args );
        };
    }
    if ( params === undefined ) {
        return source;
    }
    if ( arguments.length > 2 && params.constructor !== Array  ) {
        params = $.makeArray( arguments ).slice( 1 );
    }
    if ( params.constructor !== Array ) {
        params = [ params ];
    }
    $.each( params, function( i, n ) {
        source = source.replace( new RegExp( "\\{" + i + "\\}", "g" ), function() {
            return n;
        } );
    } );
    return source;
};

$.extend( $.validator, {

    defaults: {
        messages: {},
        groups: {},
        rules: {},
        errorClass: "error",
        pendingClass: "pending",
        validClass: "valid",
        errorElement: "label",
        focusCleanup: false,
        focusInvalid: true,
        errorContainer: $( [] ),
        errorLabelContainer: $( [] ),
        onsubmit: true,
        ignore: ":hidden",
        ignoreTitle: false,
        onfocusin: function( element ) {
            this.lastActive = element;

            // Hide error label and remove error class on focus if enabled
            if ( this.settings.focusCleanup ) {
                if ( this.settings.unhighlight ) {
                    this.settings.unhighlight.call( this, element, this.settings.errorClass, this.settings.validClass );
                }
                this.hideThese( this.errorsFor( element ) );
            }
        },
        onfocusout: function( element ) {
            if ( !this.checkable( element ) && ( element.name in this.submitted || !this.optional( element ) ) ) {
                this.element( element );
            }
        },
        onkeyup: function( element, event ) {

            // Avoid revalidate the field when pressing one of the following keys
            // Shift       => 16
            // Ctrl        => 17
            // Alt         => 18
            // Caps lock   => 20
            // End         => 35
            // Home        => 36
            // Left arrow  => 37
            // Up arrow    => 38
            // Right arrow => 39
            // Down arrow  => 40
            // Insert      => 45
            // Num lock    => 144
            // AltGr key   => 225
            var excludedKeys = [
                16, 17, 18, 20, 35, 36, 37,
                38, 39, 40, 45, 144, 225
            ];

            if ( event.which === 9 && this.elementValue( element ) === "" || $.inArray( event.keyCode, excludedKeys ) !== -1 ) {
                return;
            } else if ( element.name in this.submitted || element.name in this.invalid ) {
                this.element( element );
            }
        },
        onclick: function( element ) {

            // Click on selects, radiobuttons and checkboxes
            if ( element.name in this.submitted ) {
                this.element( element );

            // Or option elements, check parent select in that case
            } else if ( element.parentNode.name in this.submitted ) {
                this.element( element.parentNode );
            }
        },
        highlight: function( element, errorClass, validClass ) {
            if ( element.type === "radio" ) {
                this.findByName( element.name ).addClass( errorClass ).removeClass( validClass );
            } else {
                $( element ).addClass( errorClass ).removeClass( validClass );
            }
        },
        unhighlight: function( element, errorClass, validClass ) {
            if ( element.type === "radio" ) {
                this.findByName( element.name ).removeClass( errorClass ).addClass( validClass );
            } else {
                $( element ).removeClass( errorClass ).addClass( validClass );
            }
        }
    },

    // https://jqueryvalidation.org/jQuery.validator.setDefaults/
    setDefaults: function( settings ) {
        $.extend( $.validator.defaults, settings );
    },

    messages: {
        required: "This field is required.",
        remote: "Please fix this field.",
        email: "Please enter a valid email address.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        equalTo: "Please enter the same value again.",
        maxlength: $.validator.format( "Please enter no more than {0} characters." ),
        minlength: $.validator.format( "Please enter at least {0} characters." ),
        rangelength: $.validator.format( "Please enter a value between {0} and {1} characters long." ),
        range: $.validator.format( "Please enter a value between {0} and {1}." ),
        max: $.validator.format( "Please enter a value less than or equal to {0}." ),
        min: $.validator.format( "Please enter a value greater than or equal to {0}." ),
        step: $.validator.format( "Please enter a multiple of {0}." )
    },

    autoCreateRanges: false,

    prototype: {

        init: function() {
            this.labelContainer = $( this.settings.errorLabelContainer );
            this.errorContext = this.labelContainer.length && this.labelContainer || $( this.currentForm );
            this.containers = $( this.settings.errorContainer ).add( this.settings.errorLabelContainer );
            this.submitted = {};
            this.valueCache = {};
            this.pendingRequest = 0;
            this.pending = {};
            this.invalid = {};
            this.reset();

            var currentForm = this.currentForm,
                groups = ( this.groups = {} ),
                rules;
            $.each( this.settings.groups, function( key, value ) {
                if ( typeof value === "string" ) {
                    value = value.split( /\s/ );
                }
                $.each( value, function( index, name ) {
                    groups[ name ] = key;
                } );
            } );
            rules = this.settings.rules;
            $.each( rules, function( key, value ) {
                rules[ key ] = $.validator.normalizeRule( value );
            } );

            function delegate( event ) {
                var isContentEditable = typeof $( this ).attr( "contenteditable" ) !== "undefined" && $( this ).attr( "contenteditable" ) !== "false";

                // Set form expando on contenteditable
                if ( !this.form && isContentEditable ) {
                    this.form = $( this ).closest( "form" )[ 0 ];
                    this.name = $( this ).attr( "name" );
                }

                // Ignore the element if it belongs to another form. This will happen mainly
                // when setting the `form` attribute of an input to the id of another form.
                if ( currentForm !== this.form ) {
                    return;
                }

                var validator = $.data( this.form, "validator" ),
                    eventType = "on" + event.type.replace( /^validate/, "" ),
                    settings = validator.settings;
                if ( settings[ eventType ] && !$( this ).is( settings.ignore ) ) {
                    settings[ eventType ].call( validator, this, event );
                }
            }

            $( this.currentForm )
                .on( "focusin.validate focusout.validate keyup.validate",
                    ":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'], " +
                    "[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], " +
                    "[type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], " +
                    "[type='radio'], [type='checkbox'], [contenteditable], [type='button']", delegate )

                // Support: Chrome, oldIE
                // "select" is provided as event.target when clicking a option
                .on( "click.validate", "select, option, [type='radio'], [type='checkbox']", delegate );

            if ( this.settings.invalidHandler ) {
                $( this.currentForm ).on( "invalid-form.validate", this.settings.invalidHandler );
            }
        },

        // https://jqueryvalidation.org/Validator.form/
        form: function() {
            this.checkForm();
            $.extend( this.submitted, this.errorMap );
            this.invalid = $.extend( {}, this.errorMap );
            if ( !this.valid() ) {
                $( this.currentForm ).triggerHandler( "invalid-form", [ this ] );
            }
            this.showErrors();
            return this.valid();
        },

        // checkForm: function() {
        //  this.prepareForm();
        //  for ( var i = 0, elements = ( this.currentElements = this.elements() ); elements[ i ]; i++ ) {
        //      this.check( elements[ i ] );
        //  }
        //  return this.valid();
        // },


        checkForm: function() {
            this.prepareForm();
            for ( var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++ ) {
                if (this.findByName( elements[i].name ).length != undefined && this.findByName( elements[i].name ).length > 1) {
                    for (var cnt = 0; cnt < this.findByName( elements[i].name ).length; cnt++) {
                            this.check( this.findByName( elements[i].name )[cnt] );
                    }
                } else {
                    this.check( elements[i] );
                }
            }
            return this.valid();
        },

        // https://jqueryvalidation.org/Validator.element/
        element: function( element ) {
            var cleanElement = this.clean( element ),
                checkElement = this.validationTargetFor( cleanElement ),
                v = this,
                result = true,
                rs, group;

            if ( checkElement === undefined ) {
                delete this.invalid[ cleanElement.name ];
            } else {
                this.prepareElement( checkElement );
                this.currentElements = $( checkElement );

                // If this element is grouped, then validate all group elements already
                // containing a value
                group = this.groups[ checkElement.name ];
                if ( group ) {
                    $.each( this.groups, function( name, testgroup ) {
                        if ( testgroup === group && name !== checkElement.name ) {
                            cleanElement = v.validationTargetFor( v.clean( v.findByName( name ) ) );
                            if ( cleanElement && cleanElement.name in v.invalid ) {
                                v.currentElements.push( cleanElement );
                                result = v.check( cleanElement ) && result;
                            }
                        }
                    } );
                }

                rs = this.check( checkElement ) !== false;
                result = result && rs;
                if ( rs ) {
                    this.invalid[ checkElement.name ] = false;
                } else {
                    this.invalid[ checkElement.name ] = true;
                }

                if ( !this.numberOfInvalids() ) {

                    // Hide error containers on last error
                    this.toHide = this.toHide.add( this.containers );
                }
                this.showErrors();

                // Add aria-invalid status for screen readers
                $( element ).attr( "aria-invalid", !rs );
            }

            return result;
        },

        // https://jqueryvalidation.org/Validator.showErrors/
        showErrors: function( errors ) {
            if ( errors ) {
                var validator = this;

                // Add items to error list and map
                $.extend( this.errorMap, errors );
                this.errorList = $.map( this.errorMap, function( message, name ) {
                    return {
                        message: message,
                        element: validator.findByName( name )[ 0 ]
                    };
                } );

                // Remove items from success list
                this.successList = $.grep( this.successList, function( element ) {
                    return !( element.name in errors );
                } );
            }
            if ( this.settings.showErrors ) {
                this.settings.showErrors.call( this, this.errorMap, this.errorList );
            } else {
                this.defaultShowErrors();
            }
        },

        // https://jqueryvalidation.org/Validator.resetForm/
        resetForm: function() {
            if ( $.fn.resetForm ) {
                $( this.currentForm ).resetForm();
            }
            this.invalid = {};
            this.submitted = {};
            this.prepareForm();
            this.hideErrors();
            var elements = this.elements()
                .removeData( "previousValue" )
                .removeAttr( "aria-invalid" );

            this.resetElements( elements );
        },

        resetElements: function( elements ) {
            var i;

            if ( this.settings.unhighlight ) {
                for ( i = 0; elements[ i ]; i++ ) {
                    this.settings.unhighlight.call( this, elements[ i ],
                        this.settings.errorClass, "" );
                    this.findByName( elements[ i ].name ).removeClass( this.settings.validClass );
                }
            } else {
                elements
                    .removeClass( this.settings.errorClass )
                    .removeClass( this.settings.validClass );
            }
        },

        numberOfInvalids: function() {
            return this.objectLength( this.invalid );
        },

        objectLength: function( obj ) {
            /* jshint unused: false */
            var count = 0,
                i;
            for ( i in obj ) {

                // This check allows counting elements with empty error
                // message as invalid elements
                if ( obj[ i ] !== undefined && obj[ i ] !== null && obj[ i ] !== false ) {
                    count++;
                }
            }
            return count;
        },

        hideErrors: function() {
            this.hideThese( this.toHide );
        },

        hideThese: function( errors ) {
            errors.not( this.containers ).text( "" );
            this.addWrapper( errors ).hide();
        },

        valid: function() {
            return this.size() === 0;
        },

        size: function() {
            return this.errorList.length;
        },

        focusInvalid: function() {
            if ( this.settings.focusInvalid ) {
                try {
                    $( this.findLastActive() || this.errorList.length && this.errorList[ 0 ].element || [] )
                    .filter( ":visible" )
                    .trigger( "focus" )

                    // Manually trigger focusin event; without it, focusin handler isn't called, findLastActive won't have anything to find
                    .trigger( "focusin" );
                } catch ( e ) {

                    // Ignore IE throwing errors when focusing hidden elements
                }
            }
        },

        findLastActive: function() {
            var lastActive = this.lastActive;
            return lastActive && $.grep( this.errorList, function( n ) {
                return n.element.name === lastActive.name;
            } ).length === 1 && lastActive;
        },

        elements: function() {
            var validator = this,
                rulesCache = {};

            // Select all valid inputs inside the form (no submit or reset buttons)
            return $( this.currentForm )
            .find( "input, select, textarea, [contenteditable]" )
            .not( ":submit, :reset, :image, :disabled" )
            .not( this.settings.ignore )
            .filter( function() {
                var name = this.name || $( this ).attr( "name" ); // For contenteditable
                var isContentEditable = typeof $( this ).attr( "contenteditable" ) !== "undefined" && $( this ).attr( "contenteditable" ) !== "false";

                if ( !name && validator.settings.debug && window.console ) {
                    console.error( "%o has no name assigned", this );
                }

                // Set form expando on contenteditable
                if ( isContentEditable ) {
                    this.form = $( this ).closest( "form" )[ 0 ];
                    this.name = name;
                }

                // Ignore elements that belong to other/nested forms
                if ( this.form !== validator.currentForm ) {
                    return false;
                }

                // Select only the first element for each name, and only those with rules specified
                if ( name in rulesCache || !validator.objectLength( $( this ).rules() ) ) {
                    return false;
                }

                rulesCache[ name ] = true;
                return true;
            } );
        },

        clean: function( selector ) {
            return $( selector )[ 0 ];
        },

        errors: function() {
            var errorClass = this.settings.errorClass.split( " " ).join( "." );
            return $( this.settings.errorElement + "." + errorClass, this.errorContext );
        },

        resetInternals: function() {
            this.successList = [];
            this.errorList = [];
            this.errorMap = {};
            this.toShow = $( [] );
            this.toHide = $( [] );
        },

        reset: function() {
            this.resetInternals();
            this.currentElements = $( [] );
        },

        prepareForm: function() {
            this.reset();
            this.toHide = this.errors().add( this.containers );
        },

        prepareElement: function( element ) {
            this.reset();
            this.toHide = this.errorsFor( element );
        },

        elementValue: function( element ) {
            var $element = $( element ),
                type = element.type,
                isContentEditable = typeof $element.attr( "contenteditable" ) !== "undefined" && $element.attr( "contenteditable" ) !== "false",
                val, idx;

            if ( type === "radio" || type === "checkbox" ) {
                return this.findByName( element.name ).filter( ":checked" ).val();
            } else if ( type === "number" && typeof element.validity !== "undefined" ) {
                return element.validity.badInput ? "NaN" : $element.val();
            }

            if ( isContentEditable ) {
                val = $element.text();
            } else {
                val = $element.val();
            }

            if ( type === "file" ) {

                // Modern browser (chrome & safari)
                if ( val.substr( 0, 12 ) === "C:\\fakepath\\" ) {
                    return val.substr( 12 );
                }

                // Legacy browsers
                // Unix-based path
                idx = val.lastIndexOf( "/" );
                if ( idx >= 0 ) {
                    return val.substr( idx + 1 );
                }

                // Windows-based path
                idx = val.lastIndexOf( "\\" );
                if ( idx >= 0 ) {
                    return val.substr( idx + 1 );
                }

                // Just the file name
                return val;
            }

            if ( typeof val === "string" ) {
                return val.replace( /\r/g, "" );
            }
            return val;
        },

        check: function( element ) {
            element = this.validationTargetFor( this.clean( element ) );

            var rules = $( element ).rules(),
                rulesCount = $.map( rules, function( n, i ) {
                    return i;
                } ).length,
                dependencyMismatch = false,
                val = this.elementValue( element ),
                result, method, rule, normalizer;

            // Prioritize the local normalizer defined for this element over the global one
            // if the former exists, otherwise user the global one in case it exists.
            if ( typeof rules.normalizer === "function" ) {
                normalizer = rules.normalizer;
            } else if ( typeof this.settings.normalizer === "function" ) {
                normalizer = this.settings.normalizer;
            }

            // If normalizer is defined, then call it to retreive the changed value instead
            // of using the real one.
            // Note that `this` in the normalizer is `element`.
            if ( normalizer ) {
                val = normalizer.call( element, val );

                // Delete the normalizer from rules to avoid treating it as a pre-defined method.
                delete rules.normalizer;
            }

            for ( method in rules ) {
                rule = { method: method, parameters: rules[ method ] };
                try {
                    result = $.validator.methods[ method ].call( this, val, element, rule.parameters );

                    // If a method indicates that the field is optional and therefore valid,
                    // don't mark it as valid when there are no other rules
                    if ( result === "dependency-mismatch" && rulesCount === 1 ) {
                        dependencyMismatch = true;
                        continue;
                    }
                    dependencyMismatch = false;

                    if ( result === "pending" ) {
                        this.toHide = this.toHide.not( this.errorsFor( element ) );
                        return;
                    }

                    if ( !result ) {
                        this.formatAndAdd( element, rule );
                        return false;
                    }
                } catch ( e ) {
                    if ( this.settings.debug && window.console ) {
                        console.log( "Exception occurred when checking element " + element.id + ", check the '" + rule.method + "' method.", e );
                    }
                    if ( e instanceof TypeError ) {
                        e.message += ".  Exception occurred when checking element " + element.id + ", check the '" + rule.method + "' method.";
                    }

                    throw e;
                }
            }
            if ( dependencyMismatch ) {
                return;
            }
            if ( this.objectLength( rules ) ) {
                this.successList.push( element );
            }
            return true;
        },

        // Return the custom message for the given element and validation method
        // specified in the element's HTML5 data attribute
        // return the generic message if present and no method specific message is present
        customDataMessage: function( element, method ) {
            return $( element ).data( "msg" + method.charAt( 0 ).toUpperCase() +
                method.substring( 1 ).toLowerCase() ) || $( element ).data( "msg" );
        },

        // Return the custom message for the given element name and validation method
        customMessage: function( name, method ) {
            var m = this.settings.messages[ name ];
            return m && ( m.constructor === String ? m : m[ method ] );
        },

        // Return the first defined argument, allowing empty strings
        findDefined: function() {
            for ( var i = 0; i < arguments.length; i++ ) {
                if ( arguments[ i ] !== undefined ) {
                    return arguments[ i ];
                }
            }
            return undefined;
        },

        // The second parameter 'rule' used to be a string, and extended to an object literal
        // of the following form:
        // rule = {
        //     method: "method name",
        //     parameters: "the given method parameters"
        // }
        //
        // The old behavior still supported, kept to maintain backward compatibility with
        // old code, and will be removed in the next major release.
        defaultMessage: function( element, rule ) {
            if ( typeof rule === "string" ) {
                rule = { method: rule };
            }

            var message = this.findDefined(
                    this.customMessage( element.name, rule.method ),
                    this.customDataMessage( element, rule.method ),

                    // 'title' is never undefined, so handle empty string as undefined
                    !this.settings.ignoreTitle && element.title || undefined,
                    $.validator.messages[ rule.method ],
                    "<strong>Warning: No message defined for " + element.name + "</strong>"
                ),
                theregex = /\$?\{(\d+)\}/g;
            if ( typeof message === "function" ) {
                message = message.call( this, rule.parameters, element );
            } else if ( theregex.test( message ) ) {
                message = $.validator.format( message.replace( theregex, "{$1}" ), rule.parameters );
            }

            return message;
        },

        formatAndAdd: function( element, rule ) {
            var message = this.defaultMessage( element, rule );

            this.errorList.push( {
                message: message,
                element: element,
                method: rule.method
            } );

            this.errorMap[ element.name ] = message;
            this.submitted[ element.name ] = message;
        },

        addWrapper: function( toToggle ) {
            if ( this.settings.wrapper ) {
                toToggle = toToggle.add( toToggle.parent( this.settings.wrapper ) );
            }
            return toToggle;
        },

        defaultShowErrors: function() {
            var i, elements, error;
            for ( i = 0; this.errorList[ i ]; i++ ) {
                error = this.errorList[ i ];
                if ( this.settings.highlight ) {
                    this.settings.highlight.call( this, error.element, this.settings.errorClass, this.settings.validClass );
                }
                this.showLabel( error.element, error.message );
            }
            if ( this.errorList.length ) {
                this.toShow = this.toShow.add( this.containers );
            }
            if ( this.settings.success ) {
                for ( i = 0; this.successList[ i ]; i++ ) {
                    this.showLabel( this.successList[ i ] );
                }
            }
            if ( this.settings.unhighlight ) {
                for ( i = 0, elements = this.validElements(); elements[ i ]; i++ ) {
                    this.settings.unhighlight.call( this, elements[ i ], this.settings.errorClass, this.settings.validClass );
                }
            }
            this.toHide = this.toHide.not( this.toShow );
            this.hideErrors();
            this.addWrapper( this.toShow ).show();
        },

        validElements: function() {
            return this.currentElements.not( this.invalidElements() );
        },

        invalidElements: function() {
            return $( this.errorList ).map( function() {
                return this.element;
            } );
        },

        showLabel: function( element, message ) {
            var place, group, errorID, v,
                error = this.errorsFor( element ),
                elementID = this.idOrName( element ),
                describedBy = $( element ).attr( "aria-describedby" );

            if ( error.length ) {

                // Refresh error/success class
                error.removeClass( this.settings.validClass ).addClass( this.settings.errorClass );

                // Replace message on existing label
                error.html( message );
            } else {

                // Create error element
                error = $( "<" + this.settings.errorElement + ">" )
                    .attr( "id", elementID + "-error" )
                    .addClass( this.settings.errorClass )
                    .html( message || "" );

                // Maintain reference to the element to be placed into the DOM
                place = error;
                if ( this.settings.wrapper ) {

                    // Make sure the element is visible, even in IE
                    // actually showing the wrapped element is handled elsewhere
                    place = error.hide().show().wrap( "<" + this.settings.wrapper + "/>" ).parent();
                }
                if ( this.labelContainer.length ) {
                    this.labelContainer.append( place );
                } else if ( this.settings.errorPlacement ) {
                    this.settings.errorPlacement.call( this, place, $( element ) );
                } else {
                    place.insertAfter( element );
                }

                // Link error back to the element
                if ( error.is( "label" ) ) {

                    // If the error is a label, then associate using 'for'
                    error.attr( "for", elementID );

                    // If the element is not a child of an associated label, then it's necessary
                    // to explicitly apply aria-describedby
                } else if ( error.parents( "label[for='" + this.escapeCssMeta( elementID ) + "']" ).length === 0 ) {
                    errorID = error.attr( "id" );

                    // Respect existing non-error aria-describedby
                    if ( !describedBy ) {
                        describedBy = errorID;
                    } else if ( !describedBy.match( new RegExp( "\\b" + this.escapeCssMeta( errorID ) + "\\b" ) ) ) {

                        // Add to end of list if not already present
                        describedBy += " " + errorID;
                    }
                    $( element ).attr( "aria-describedby", describedBy );

                    // If this element is grouped, then assign to all elements in the same group
                    group = this.groups[ element.name ];
                    if ( group ) {
                        v = this;
                        $.each( v.groups, function( name, testgroup ) {
                            if ( testgroup === group ) {
                                $( "[name='" + v.escapeCssMeta( name ) + "']", v.currentForm )
                                    .attr( "aria-describedby", error.attr( "id" ) );
                            }
                        } );
                    }
                }
            }
            if ( !message && this.settings.success ) {
                error.text( "" );
                if ( typeof this.settings.success === "string" ) {
                    error.addClass( this.settings.success );
                } else {
                    this.settings.success( error, element );
                }
            }
            this.toShow = this.toShow.add( error );
        },

        errorsFor: function( element ) {
            var name = this.escapeCssMeta( this.idOrName( element ) ),
                describer = $( element ).attr( "aria-describedby" ),
                selector = "label[for='" + name + "'], label[for='" + name + "'] *";

            // 'aria-describedby' should directly reference the error element
            if ( describer ) {
                selector = selector + ", #" + this.escapeCssMeta( describer )
                    .replace( /\s+/g, ", #" );
            }

            return this
                .errors()
                .filter( selector );
        },

        // See https://api.jquery.com/category/selectors/, for CSS
        // meta-characters that should be escaped in order to be used with JQuery
        // as a literal part of a name/id or any selector.
        escapeCssMeta: function( string ) {
            return string.replace( /([\\!"#$%&'()*+,./:;<=>?@\[\]^`{|}~])/g, "\\$1" );
        },

        idOrName: function( element ) {
            return this.groups[ element.name ] || ( this.checkable( element ) ? element.name : element.id || element.name );
        },

        validationTargetFor: function( element ) {

            // If radio/checkbox, validate first element in group instead
            if ( this.checkable( element ) ) {
                element = this.findByName( element.name );
            }

            // Always apply ignore filter
            return $( element ).not( this.settings.ignore )[ 0 ];
        },

        checkable: function( element ) {
            return ( /radio|checkbox/i ).test( element.type );
        },

        findByName: function( name ) {
            return $( this.currentForm ).find( "[name='" + this.escapeCssMeta( name ) + "']" );
        },

        getLength: function( value, element ) {
            switch ( element.nodeName.toLowerCase() ) {
            case "select":
                return $( "option:selected", element ).length;
            case "input":
                if ( this.checkable( element ) ) {
                    return this.findByName( element.name ).filter( ":checked" ).length;
                }
            }
            return value.length;
        },

        depend: function( param, element ) {
            return this.dependTypes[ typeof param ] ? this.dependTypes[ typeof param ]( param, element ) : true;
        },

        dependTypes: {
            "boolean": function( param ) {
                return param;
            },
            "string": function( param, element ) {
                return !!$( param, element.form ).length;
            },
            "function": function( param, element ) {
                return param( element );
            }
        },

        optional: function( element ) {
            var val = this.elementValue( element );
            return !$.validator.methods.required.call( this, val, element ) && "dependency-mismatch";
        },

        startRequest: function( element ) {
            if ( !this.pending[ element.name ] ) {
                this.pendingRequest++;
                $( element ).addClass( this.settings.pendingClass );
                this.pending[ element.name ] = true;
            }
        },

        stopRequest: function( element, valid ) {
            this.pendingRequest--;

            // Sometimes synchronization fails, make sure pendingRequest is never < 0
            if ( this.pendingRequest < 0 ) {
                this.pendingRequest = 0;
            }
            delete this.pending[ element.name ];
            $( element ).removeClass( this.settings.pendingClass );
            if ( valid && this.pendingRequest === 0 && this.formSubmitted && this.form() ) {
                $( this.currentForm ).submit();

                // Remove the hidden input that was used as a replacement for the
                // missing submit button. The hidden input is added by `handle()`
                // to ensure that the value of the used submit button is passed on
                // for scripted submits triggered by this method
                if ( this.submitButton ) {
                    $( "input:hidden[name='" + this.submitButton.name + "']", this.currentForm ).remove();
                }

                this.formSubmitted = false;
            } else if ( !valid && this.pendingRequest === 0 && this.formSubmitted ) {
                $( this.currentForm ).triggerHandler( "invalid-form", [ this ] );
                this.formSubmitted = false;
            }
        },

        previousValue: function( element, method ) {
            method = typeof method === "string" && method || "remote";

            return $.data( element, "previousValue" ) || $.data( element, "previousValue", {
                old: null,
                valid: true,
                message: this.defaultMessage( element, { method: method } )
            } );
        },

        // Cleans up all forms and elements, removes validator-specific events
        destroy: function() {
            this.resetForm();

            $( this.currentForm )
                .off( ".validate" )
                .removeData( "validator" )
                .find( ".validate-equalTo-blur" )
                    .off( ".validate-equalTo" )
                    .removeClass( "validate-equalTo-blur" )
                .find( ".validate-lessThan-blur" )
                    .off( ".validate-lessThan" )
                    .removeClass( "validate-lessThan-blur" )
                .find( ".validate-lessThanEqual-blur" )
                    .off( ".validate-lessThanEqual" )
                    .removeClass( "validate-lessThanEqual-blur" )
                .find( ".validate-greaterThanEqual-blur" )
                    .off( ".validate-greaterThanEqual" )
                    .removeClass( "validate-greaterThanEqual-blur" )
                .find( ".validate-greaterThan-blur" )
                    .off( ".validate-greaterThan" )
                    .removeClass( "validate-greaterThan-blur" );
        }

    },

    classRuleSettings: {
        required: { required: true },
        email: { email: true },
        url: { url: true },
        date: { date: true },
        dateISO: { dateISO: true },
        number: { number: true },
        digits: { digits: true },
        creditcard: { creditcard: true }
    },

    addClassRules: function( className, rules ) {
        if ( className.constructor === String ) {
            this.classRuleSettings[ className ] = rules;
        } else {
            $.extend( this.classRuleSettings, className );
        }
    },

    classRules: function( element ) {
        var rules = {},
            classes = $( element ).attr( "class" );

        if ( classes ) {
            $.each( classes.split( " " ), function() {
                if ( this in $.validator.classRuleSettings ) {
                    $.extend( rules, $.validator.classRuleSettings[ this ] );
                }
            } );
        }
        return rules;
    },

    normalizeAttributeRule: function( rules, type, method, value ) {

        // Convert the value to a number for number inputs, and for text for backwards compability
        // allows type="date" and others to be compared as strings
        if ( /min|max|step/.test( method ) && ( type === null || /number|range|text/.test( type ) ) ) {
            value = Number( value );

            // Support Opera Mini, which returns NaN for undefined minlength
            if ( isNaN( value ) ) {
                value = undefined;
            }
        }

        if ( value || value === 0 ) {
            rules[ method ] = value;
        } else if ( type === method && type !== "range" ) {

            // Exception: the jquery validate 'range' method
            // does not test for the html5 'range' type
            rules[ method ] = true;
        }
    },

    attributeRules: function( element ) {
        var rules = {},
            $element = $( element ),
            type = element.getAttribute( "type" ),
            method, value;

        for ( method in $.validator.methods ) {

            // Support for <input required> in both html5 and older browsers
            if ( method === "required" ) {
                value = element.getAttribute( method );

                // Some browsers return an empty string for the required attribute
                // and non-HTML5 browsers might have required="" markup
                if ( value === "" ) {
                    value = true;
                }

                // Force non-HTML5 browsers to return bool
                value = !!value;
            } else {
                value = $element.attr( method );
            }

            this.normalizeAttributeRule( rules, type, method, value );
        }

        // 'maxlength' may be returned as -1, 2147483647 ( IE ) and 524288 ( safari ) for text inputs
        if ( rules.maxlength && /-1|2147483647|524288/.test( rules.maxlength ) ) {
            delete rules.maxlength;
        }

        return rules;
    },

    dataRules: function( element ) {
        var rules = {},
            $element = $( element ),
            type = element.getAttribute( "type" ),
            method, value;

        for ( method in $.validator.methods ) {
            value = $element.data( "rule" + method.charAt( 0 ).toUpperCase() + method.substring( 1 ).toLowerCase() );

            // Cast empty attributes like `data-rule-required` to `true`
            if ( value === "" ) {
                value = true;
            }

            this.normalizeAttributeRule( rules, type, method, value );
        }
        return rules;
    },

    staticRules: function( element ) {
        var rules = {},
            validator = $.data( element.form, "validator" );

        if ( validator.settings.rules ) {
            rules = $.validator.normalizeRule( validator.settings.rules[ element.name ] ) || {};
        }
        return rules;
    },

    normalizeRules: function( rules, element ) {

        // Handle dependency check
        $.each( rules, function( prop, val ) {

            // Ignore rule when param is explicitly false, eg. required:false
            if ( val === false ) {
                delete rules[ prop ];
                return;
            }
            if ( val.param || val.depends ) {
                var keepRule = true;
                switch ( typeof val.depends ) {
                case "string":
                    keepRule = !!$( val.depends, element.form ).length;
                    break;
                case "function":
                    keepRule = val.depends.call( element, element );
                    break;
                }
                if ( keepRule ) {
                    rules[ prop ] = val.param !== undefined ? val.param : true;
                } else {
                    $.data( element.form, "validator" ).resetElements( $( element ) );
                    delete rules[ prop ];
                }
            }
        } );

        // Evaluate parameters
        $.each( rules, function( rule, parameter ) {
            rules[ rule ] = typeof parameter === "function" && rule !== "normalizer" ? parameter( element ) : parameter;
        } );

        // Clean number parameters
        $.each( [ "minlength", "maxlength" ], function() {
            if ( rules[ this ] ) {
                rules[ this ] = Number( rules[ this ] );
            }
        } );
        $.each( [ "rangelength", "range" ], function() {
            var parts;
            if ( rules[ this ] ) {
                if ( Array.isArray( rules[ this ] ) ) {
                    rules[ this ] = [ Number( rules[ this ][ 0 ] ), Number( rules[ this ][ 1 ] ) ];
                } else if ( typeof rules[ this ] === "string" ) {
                    parts = rules[ this ].replace( /[\[\]]/g, "" ).split( /[\s,]+/ );
                    rules[ this ] = [ Number( parts[ 0 ] ), Number( parts[ 1 ] ) ];
                }
            }
        } );

        if ( $.validator.autoCreateRanges ) {

            // Auto-create ranges
            if ( rules.min != null && rules.max != null ) {
                rules.range = [ rules.min, rules.max ];
                delete rules.min;
                delete rules.max;
            }
            if ( rules.minlength != null && rules.maxlength != null ) {
                rules.rangelength = [ rules.minlength, rules.maxlength ];
                delete rules.minlength;
                delete rules.maxlength;
            }
        }

        return rules;
    },

    // Converts a simple string to a {string: true} rule, e.g., "required" to {required:true}
    normalizeRule: function( data ) {
        if ( typeof data === "string" ) {
            var transformed = {};
            $.each( data.split( /\s/ ), function() {
                transformed[ this ] = true;
            } );
            data = transformed;
        }
        return data;
    },

    // https://jqueryvalidation.org/jQuery.validator.addMethod/
    addMethod: function( name, method, message ) {
        $.validator.methods[ name ] = method;
        $.validator.messages[ name ] = message !== undefined ? message : $.validator.messages[ name ];
        if ( method.length < 3 ) {
            $.validator.addClassRules( name, $.validator.normalizeRule( name ) );
        }
    },

    // https://jqueryvalidation.org/jQuery.validator.methods/
    methods: {

        // https://jqueryvalidation.org/required-method/
        required: function( value, element, param ) {

            // Check if dependency is met
            if ( !this.depend( param, element ) ) {
                return "dependency-mismatch";
            }
            if ( element.nodeName.toLowerCase() === "select" ) {

                // Could be an array for select-multiple or a string, both are fine this way
                var val = $( element ).val();
                return val && val.length > 0;
            }
            if ( this.checkable( element ) ) {
                return this.getLength( value, element ) > 0;
            }
            return value !== undefined && value !== null && value.length > 0;
        },

        // https://jqueryvalidation.org/email-method/
        email: function( value, element ) {

            // From https://html.spec.whatwg.org/multipage/forms.html#valid-e-mail-address
            // Retrieved 2014-01-14
            // If you have a problem with this implementation, report a bug against the above spec
            // Or use custom methods to implement your own email validation
            return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test( value );
        },

        // https://jqueryvalidation.org/url-method/
        url: function( value, element ) {

            // Copyright (c) 2010-2013 Diego Perini, MIT licensed
            // https://gist.github.com/dperini/729294
            // see also https://mathiasbynens.be/demo/url-regex
            // modified to allow protocol-relative URLs
            return this.optional( element ) || /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z0-9\u00a1-\uffff][a-z0-9\u00a1-\uffff_-]{0,62})?[a-z0-9\u00a1-\uffff]\.)+(?:[a-z\u00a1-\uffff]{2,}\.?))(?::\d{2,5})?(?:[/?#]\S*)?$/i.test( value );
        },

        // https://jqueryvalidation.org/date-method/
        date: ( function() {
            var called = false;

            return function( value, element ) {
                if ( !called ) {
                    called = true;
                    if ( this.settings.debug && window.console ) {
                        console.warn(
                            "The `date` method is deprecated and will be removed in version '2.0.0'.\n" +
                            "Please don't use it, since it relies on the Date constructor, which\n" +
                            "behaves very differently across browsers and locales. Use `dateISO`\n" +
                            "instead or one of the locale specific methods in `localizations/`\n" +
                            "and `additional-methods.js`."
                        );
                    }
                }

                return this.optional( element ) || !/Invalid|NaN/.test( new Date( value ).toString() );
            };
        }() ),

        // https://jqueryvalidation.org/dateISO-method/
        dateISO: function( value, element ) {
            return this.optional( element ) || /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test( value );
        },

        // https://jqueryvalidation.org/number-method/
        number: function( value, element ) {
            return this.optional( element ) || /^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test( value );
        },

        // https://jqueryvalidation.org/digits-method/
        digits: function( value, element ) {
            return this.optional( element ) || /^\d+$/.test( value );
        },

        // https://jqueryvalidation.org/minlength-method/
        minlength: function( value, element, param ) {
            var length = Array.isArray( value ) ? value.length : this.getLength( value, element );
            return this.optional( element ) || length >= param;
        },

        // https://jqueryvalidation.org/maxlength-method/
        maxlength: function( value, element, param ) {
            var length = Array.isArray( value ) ? value.length : this.getLength( value, element );
            return this.optional( element ) || length <= param;
        },

        // https://jqueryvalidation.org/rangelength-method/
        rangelength: function( value, element, param ) {
            var length = Array.isArray( value ) ? value.length : this.getLength( value, element );
            return this.optional( element ) || ( length >= param[ 0 ] && length <= param[ 1 ] );
        },

        // https://jqueryvalidation.org/min-method/
        min: function( value, element, param ) {
            return this.optional( element ) || value >= param;
        },

        // https://jqueryvalidation.org/max-method/
        max: function( value, element, param ) {
            return this.optional( element ) || value <= param;
        },

        // https://jqueryvalidation.org/range-method/
        range: function( value, element, param ) {
            return this.optional( element ) || ( value >= param[ 0 ] && value <= param[ 1 ] );
        },

        // https://jqueryvalidation.org/step-method/
        step: function( value, element, param ) {
            var type = $( element ).attr( "type" ),
                errorMessage = "Step attribute on input type " + type + " is not supported.",
                supportedTypes = [ "text", "number", "range" ],
                re = new RegExp( "\\b" + type + "\\b" ),
                notSupported = type && !re.test( supportedTypes.join() ),
                decimalPlaces = function( num ) {
                    var match = ( "" + num ).match( /(?:\.(\d+))?$/ );
                    if ( !match ) {
                        return 0;
                    }

                    // Number of digits right of decimal point.
                    return match[ 1 ] ? match[ 1 ].length : 0;
                },
                toInt = function( num ) {
                    return Math.round( num * Math.pow( 10, decimals ) );
                },
                valid = true,
                decimals;

            // Works only for text, number and range input types
            // TODO find a way to support input types date, datetime, datetime-local, month, time and week
            if ( notSupported ) {
                throw new Error( errorMessage );
            }

            decimals = decimalPlaces( param );

            // Value can't have too many decimals
            if ( decimalPlaces( value ) > decimals || toInt( value ) % toInt( param ) !== 0 ) {
                valid = false;
            }

            return this.optional( element ) || valid;
        },

        // https://jqueryvalidation.org/equalTo-method/
        equalTo: function( value, element, param ) {

            // Bind to the blur event of the target in order to revalidate whenever the target field is updated
            var target = $( param );
            if ( this.settings.onfocusout && target.not( ".validate-equalTo-blur" ).length ) {
                target.addClass( "validate-equalTo-blur" ).on( "blur.validate-equalTo", function() {
                    $( element ).valid();
                } );
            }
            return value === target.val();
        },

        // https://jqueryvalidation.org/remote-method/
        remote: function( value, element, param, method ) {
            if ( this.optional( element ) ) {
                return "dependency-mismatch";
            }

            method = typeof method === "string" && method || "remote";

            var previous = this.previousValue( element, method ),
                validator, data, optionDataString;

            if ( !this.settings.messages[ element.name ] ) {
                this.settings.messages[ element.name ] = {};
            }
            previous.originalMessage = previous.originalMessage || this.settings.messages[ element.name ][ method ];
            this.settings.messages[ element.name ][ method ] = previous.message;

            param = typeof param === "string" && { url: param } || param;
            optionDataString = $.param( $.extend( { data: value }, param.data ) );
            if ( previous.old === optionDataString ) {
                return previous.valid;
            }

            previous.old = optionDataString;
            validator = this;
            this.startRequest( element );
            data = {};
            data[ element.name ] = value;
            $.ajax( $.extend( true, {
                mode: "abort",
                port: "validate" + element.name,
                dataType: "json",
                data: data,
                context: validator.currentForm,
                success: function( response ) {
                    var valid = response === true || response === "true",
                        errors, message, submitted;

                    validator.settings.messages[ element.name ][ method ] = previous.originalMessage;
                    if ( valid ) {
                        submitted = validator.formSubmitted;
                        validator.resetInternals();
                        validator.toHide = validator.errorsFor( element );
                        validator.formSubmitted = submitted;
                        validator.successList.push( element );
                        validator.invalid[ element.name ] = false;
                        validator.showErrors();
                    } else {
                        errors = {};
                        message = response || validator.defaultMessage( element, { method: method, parameters: value } );
                        errors[ element.name ] = previous.message = message;
                        validator.invalid[ element.name ] = true;
                        validator.showErrors( errors );
                    }
                    previous.valid = valid;
                    validator.stopRequest( element, valid );
                }
            }, param ) );
            return "pending";
        }
    }

} );

// Ajax mode: abort
// usage: $.ajax({ mode: "abort"[, port: "uniqueport"]});
// if mode:"abort" is used, the previous request on that port (port can be undefined) is aborted via XMLHttpRequest.abort()

var pendingRequests = {},
    ajax;

// Use a prefilter if available (1.5+)
if ( $.ajaxPrefilter ) {
    $.ajaxPrefilter( function( settings, _, xhr ) {
        var port = settings.port;
        if ( settings.mode === "abort" ) {
            if ( pendingRequests[ port ] ) {
                pendingRequests[ port ].abort();
            }
            pendingRequests[ port ] = xhr;
        }
    } );
} else {

    // Proxy ajax
    ajax = $.ajax;
    $.ajax = function( settings ) {
        var mode = ( "mode" in settings ? settings : $.ajaxSettings ).mode,
            port = ( "port" in settings ? settings : $.ajaxSettings ).port;
        if ( mode === "abort" ) {
            if ( pendingRequests[ port ] ) {
                pendingRequests[ port ].abort();
            }
            pendingRequests[ port ] = ajax.apply( this, arguments );
            return pendingRequests[ port ];
        }
        return ajax.apply( this, arguments );
    };
}
return $;
}));


$(function () {

  $('select[required]').css({
    position: 'absolute',
    display: 'inline',
    height: 0,
    padding: 0,
    border: '1px solid rgba(255,255,255,0)',
    width: 0
  });

//Date Formate Validate
 $.validator.addMethod("dateFormat",
        function(value, element) {
            var rxDatePattern = /(?:0[1-9]|[12][0-9]|3[01])\/(?:0[1-9]|1[0-2])\/(?:19|20\d{2})/;
            return value.match(rxDatePattern);
        },
        "Please enter a date in the format dd/mm/yyyy.");



 //Phone Formate Validate
 $.validator.addMethod("phoneFormat",
        function(value, element) {
            var rxDatePattern = /(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/;
            return value.match(rxDatePattern);
        },
        "Please Enter Valid Phone Number.");

//Gender Formate Validate
$.validator.addMethod("genderFormat",
			 function(value, element){
            if (value == "male" || value == "female" || value == "other") {
                return true;
            }
        },
        "Please Enter Valid Data.");

//Religion Formate Validate
$.validator.addMethod("religionFormat",
			 function(value, element){
            if (value == "hinduism" || value == "islam" || value == "buddhists" || value == "christianity") {
                return true;
            }
        },
        "Please Enter Valid Data.");

//City Formate Validate
$.validator.addMethod("cityFormat",
			 function(value, element){
            if (value == "bangladesh") {
                return true;
            }
        },
        "Please Enter Valid Data.");

//social Formate Validate
$.validator.addMethod("socialValid",
             function(value, element){
            if (value == "facebook" || value == "twitter" || value == "linkedIn" || value == "instagram") {
                return true;
            }
        },
        "Please Enter Valid Data.");

//slider Style Formate Validate
$.validator.addMethod("slideStyle",
             function(value, element){
            if (value == "cube" || value == "cubeRandom" || value == "block" || value == "cubeStop" || value == "cubeStopRandom" || value == "cubeHide" || value == "cubeSize" || value == "horizontal" || value == "showBars" || value == "showBarsRandom" || value == "tube" || value == "fade" || value == "fadeFour" || value == "paralell" || value == "blind" || value == "blindHeight" || value == "blindWidth" || value == "directionTop" || value == "directionBottom" || value == "directionRight" || value == "directionLeft" || value == "cubeSpread" || value == "glassCube" || value == "glassBlock" || value == "circles" || value == "circlesInside" || value == "circlesRotate" || value == "cubeShow" || value == "upBars" || value == "downBars" || value == "hideBars" || value == "swapBars" || value == "swapBarsBack" || value == "swapBlocks" || value == "cut") {
                return true;
            }
        },
        "Please Enter Valid Data.");


//role Formate Validate
$.validator.addMethod("roleValid",
             function(value, element){
            if (value == "admin" || value == "teacher" || value == "student") {
                return true;
            }
        },
        "Please Enter Valid Data.");

//status Formate Validate
$.validator.addMethod("statusActiveInactive",
             function(value, element){
            if (value == "active" || value == "inactive") {
                return true;
            }
        },
        "Please Enter Valid Data.");

//position Formate Validate
$.validator.addMethod("positionLeftRight",
             function(value, element){
            if (value == "left" || value == "right") {
                return true;
            }
        },
        "Please Enter Valid Data.");

//Button On/Off Formate Validate
$.validator.addMethod("buttonOnOff",
             function(value, element){
            if (value == "on" || value == "off") {
                return true;
            }
        },
        "Please Enter Valid Data.");


 //Dashboard Login form Validate
  $("#login_form").validate({
    rules: {
      email: {
        required: true,
      },

      password: {
        required: true,
      },
       remember: {
        required: false,
      },
 

      },
      //For custom messages
      messages: {

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });


//user form Validate
 $("#formValidate").validate({
    rules:{
        username: {
            required: true,
            minlength: 5,
            remote:{
                 url: "/users/varifyusername",
                 type: "GET",
                 data: {
                    username: function() {
                    return $( "#username" ).val();
                  }
                }
            }

        },
        firstName:{
            required: true,
        },
        lastName:{
            required: true,
        },
        phone:{
            required: true,
            phoneFormat:true,
            minlength: 11,
            maxlength: 11,
        },
        email: {
            required: false,
            email:true,
            remote:{
                 url: "/users/varifyemail",
                 type: "GET",
                 data: {
                    email: function() {
                    return $( "#email" ).val();
                  }
                }
            }
        },
         gender: {
            required: true,
            genderFormat:true,

        },
        religion: {
            required: true,
            religionFormat: true,
        },
        dob: {
            required: true,
            dateFormat:true,

        },
        city: {
            required: true,
            cityFormat:true,
        },
         address1: {
            maxlength: 255,
            required: true,
        },
         address2: {
            maxlength: 255,
            required: true,
        },
        image: {
            required: true,
        },
        'socialicon[]':{
         required: true,
         socialValid:true,
        },
         'socialUrl[]': {
             required: true,
             url: true,
        },
         role: {
            required: true,
            roleValid:true,
        },
        status: {
            required: true,
            statusActiveInactive:true,
        },
          'institute_name[]':{
         required: true,
        },
         'subject[]': {
             required: true,
        },
        'qualification[]': {
             required: true,
        },
         password: {
            required: true,
             minlength: 6
        },
         cpassword: {
            required: true,
            equalTo: "#password"
        },



    },

       //For custom messages
      messages: {
        username:{
            remote: 'The username is already in use!'
        },
        email:{
            remote: 'The Email is already in use!'
        },

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }
 })
 $('select').on("change", function(e) {
    $(this).valid()
});


 //general setting form Validate
 $("#generalsettings").validate({
    rules: {
      name: {
        required: true,
          remote:{
                 url: "/general/varifyname",
                 type: "GET",
                 data: {
                    name: function() {
                    return $( "#name" ).val();
                  }
                }
            }
      },
      icon: {
        required: true,
      },
      text: {
        required: true,
        maxlength: 200,

      },
      status: {
        required: true,
        statusActiveInactive:true,
      },



      },
      //For custom messages
      messages: {
       name:{
            remote: 'The name is already in use!'
        },
      curl: "Enter your website",
      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });


 //general update setting form Validate
 $("#Updategeneralsettings").validate({
    rules: {

      icon: {
        required: true,
      },
      text: {
        required: true,
        maxlength: 200,

      },
      status: {
        required: true,
        statusActiveInactive:true,
      },

        name: {
        required: true,
          remote:{
                 url: "/general/update/varifyname",
                 type: "GET",
                 data: {
                    id:$("#hiddenVal").val(),
                    name: function() {
                    return $( "#name" ).val();
                  }

                }
            }
      },



      },
      //For custom messages
      messages: {
       name:{
            remote: 'The name is already in use!'
        },
      curl: "Enter your website",
      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });


  //Social setting form Validate
 $("#socialsettings").validate({
    rules: {
      socialname: {
        required: true,
          remote:{
                 url: "/general/socialvarifyname",
                 type: "GET",
                 data: {
                    name: function() {
                    return $( "#socialname" ).val();
                  }
                }
            }
      },
      socialicon: {
        required: true,
      },
      url: {
        required: true,
        url:true

      },
      socialstatus: {
        required: true,
        statusActiveInactive:true,
      },



      },
      //For custom messages
      messages: {
       socialname:{
            remote: 'The name is already in use!'
        },
      curl: "Enter your website",
      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });


   //Social setting form Validate
 $("#Updatesocialsettings").validate({
    rules: {
      socialname: {
        required: true,
          remote:{
                 url: "/general/update/socialvarifyname",
                 type: "GET",
                 data: {
                    id:$("#hiddenVal").val(),
                    name: function() {
                    return $( "#socialname" ).val();
                  }
                }
            }
      },
      socialicon: {
        required: true,
      },
      url: {
        required: true,
        url:true

      },
      socialstatus: {
        required: true,
        statusActiveInactive:true,
      },



      },
      //For custom messages
      messages: {
       socialname:{
            remote: 'The name is already in use!'
        },
      curl: "Enter your website",
      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });





//headersettings setting form Validate
 $("#headersettings").validate({
    rules: {
      title: {
        required: true,
        maxlength: 100,
      },
      icon: {
        required: true,
      },
       author_name: {
        required: false,
         maxlength: 50,
      },

      text: {
        required: true,
        maxlength: 200,

      },
      status: {
        required: true,
        statusActiveInactive:true,
      },



      },
      //For custom messages
      messages: {
       name:{
            remote: 'The name is already in use!'
        },
      curl: "Enter your website",
      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });


//newsscroll setting form Validate
 $("#newssettings").validate({
    rules: {
      title: {
        required: true,
        maxlength: 200,
      },
      url: {
        required: false,
         url: true,
      },
      status: {
        required: true,
        statusActiveInactive:true,
      },



      },
      //For custom messages
      messages: {

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });


 //slider setting form Validate
 $("#slidersettings").validate({
    rules: {
      title: {
        required: false,
        maxlength: 300,
      },
      style: {
        required: true,
        slideStyle:true,
      },
      status: {
        required: true,
        statusActiveInactive:true,
      },
       image: {
            required: true,
        },



      },
      //For custom messages
      messages: {

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });


  //Update slider settings form Validate
 $("#Updateslidersettings").validate({
    rules: {
      title: {
        required: false,
        maxlength: 300,
      },
      style: {
        required: true,
        slideStyle:true,
      },
      status: {
        required: true,
        statusActiveInactive:true,
      },
       image: {
            required: false,
        },



      },
      //For custom messages
      messages: {

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });




//about setting form Validate
$(document).ready(function(){

    $("#aboutsubmit").click( function(e) {

            var text = tinyMCE.activeEditor.getContent();
            if(text === "" || text === null){
                $("#questionValid").html("<span>This field is required</span>");
                return false;
            } else {
                $("#questionValid").html("");
            }


         $("#aboutsettings").validate({

            rules: {
              title: {
                required: false,
                maxlength: 500,
              },
              image: {
                required: true,
                },
             oldImage: {
                required: false,
             },

              },
              //For custom messages
              messages: {

              },
              errorElement : 'div',
              errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                  $(placement).append(error)
                } else {
              error.insertAfter(element);
              }
            }

          });
    });



});


    function tinymceValidation() {
        var content = tinyMCE.activeEditor.getContent();
        if (content === "" || content === null) {
            $("#questionValid").html("<span>This field is required.</span>");
            return false;
        } else {
            $("#questionValid").html("");
        }

    }

    tinymce.activeEditor.on('keyup', function (e) {
        tinymceValidation();
    });


});


//servicesettings setting form Validate
 $("#servicesettings").validate({
    rules: {
      title: {
        required: true,
        maxlength: 100,
      },
      icon: {
        required: true,
      },

      text: {
        required: true,
        maxlength: 200,

      },
      status: {
        required: true,
        statusActiveInactive:true,
      },


      },
      //For custom messages
      messages: {
       name:{
            remote: 'The name is already in use!'
        },
      curl: "Enter your website",
      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });

 //Study Institute setting form Validate
 $("#institutesettings").validate({
    rules: {
      title: {
        required: true,
        maxlength: 200,
      },

      text: {
        required: false,
        maxlength: 300,

      },
      status: {
        required: true,
        statusActiveInactive:true,
      },

      },
      //For custom messages
      messages: {

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });


  //setting form Validate
 $("#Basicsettings").validate({
    rules: {
      name: {
        required: true,
        maxlength: 50,
      },

      logo: {
        required: true,
      },
      favicon: {
        required: true,

      },

      },
      //For custom messages
      messages: {

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });

 //Update setting form Validate
  $("#Updatesettings").validate({
    rules: {
      name: {
        required: true,
        maxlength: 50,
      },

      logo: {
        required: false,
      },
      favicon: {
        required: false,

      },

      },
      //For custom messages
      messages: {

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });


//Course Advertisement settings Add form Validate
 $("#courseAdvertismentsettings").validate({
    rules: {
      title: {
        required: true,
        maxlength: 200,
      },
      position: {
        required: true,
        positionLeftRight:true,
      },

      text: {
        required: true,
      },
      btn: {
        required: true,
        buttonOnOff:true,
      },
   
       btn_url: {
        required: false,
        url:true,
      },
      image: {
        required: true,
      },
    status: {
        required: true,
        statusActiveInactive:true,
      },

      },
      //For custom messages
      messages: {

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });
//Update Course Advertisement settings form Validate

  $("#UpdatecourseAdvertisment").validate({
    rules: {
      title: {
        required: true,
        maxlength: 200,
      },
      position: {
        required: true,
        positionLeftRight:true,
      },

      text: {
        required: true,
      },
      btn: {
        required: true,
        buttonOnOff:true,
      },
   
       btn_url: {
        required: false,
        url:true,
      },
      image: {
        required: false,
      },
    status: {
        required: true,
        statusActiveInactive:true,
      },

      },
      //For custom messages
      messages: {

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }

  });


  //registration_form Validate for user
 $("#registration_form").validate({
    rules:{
        username: {
            required: true,
            minlength: 5,
            remote:{
                 url: "/users/varifyusername",
                 type: "GET",
                 data: {
                    username: function() {
                    return $( "#username" ).val();
                  }
                }
            }

        },
       
        mobile:{
            required: true,
            phoneFormat:true,
            minlength: 11,
            maxlength: 11,
        },
        email: {
            required: false,
            email:true,
            remote:{
                 url: "/users/varifyemail",
                 type: "GET",
                 data: {
                    email: function() {
                    return $( "#email" ).val();
                  }
                }
            }
        },
   
         password: {
            required: true,
             minlength: 6
        },
         password_confirmation: {
            required: true,
            equalTo: "#password"
        },



    },

       //For custom messages
      messages: {
        username:{
            remote: 'The username is already in use!'
        },
        email:{
            remote: 'The Email is already in use!'
        },

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }
 })



  //forgetpassword Validate for user
 $("#forgetpassword").validate({
    rules:{
        email: {
            required: true,
            email:true,
         
        },
   
  
    },

       //For custom messages
      messages: {
      
      

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }
 })


  //passwordLink Validate for user
 $("#passwordLink").validate({
    rules:{
     
        email: {
            required: true,
            email:true,
          
        },
   
         password: {
            required: true,
             minlength: 6
        },
         password_confirmation: {
            required: true,
            equalTo: "#password"
        },



    },

       //For custom messages
      messages: {
        username:{
            remote: 'The username is already in use!'
        },
        email:{
            remote: 'The Email is already in use!'
        },

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }
 });



//Que And Ans setting form Validate

$(document).ready(function(){

    $("#qusAndanssubmit").click( function(e) {

            var text = tinyMCE.activeEditor.getContent();
            if(text === "" || text === null){
                $("#questionValid").html("<span>This field is required</span>");
                return false;
            } else {
                $("#questionValid").html("");
            }


         $("#qusAndanssettings").validate({

            rules: {
              qus: {
                required: true,

              },
               status: {
                    required: true,
                    statusActiveInactive:true,
                },
           

              },
              //For custom messages
              messages: {

              },
              errorElement : 'div',
              errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                  $(placement).append(error)
                } else {
              error.insertAfter(element);
              }
            }

          });
    });



});


  //socialShare Validate for user
 $("#SocialSharesettings").validate({
    rules:{
     
        'name[]': {
            required: true,

          
        },
   
         status: {
            required: true,
            statusActiveInactive:true,
        },
         title: {
            required: true,
        },
        url: {
            required: true,
            url: true,
        },



    },

       //For custom messages
      messages: {
        username:{
            remote: 'The username is already in use!'
        },
        email:{
            remote: 'The Email is already in use!'
        },

      },
      errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
      error.insertAfter(element);
      }
    }
 });


//Admin setting form Validate

$(document).ready(function(){

    $("#AdminDetailssubmit").click( function(e) {

            var text = tinyMCE.activeEditor.getContent();
            if(text === "" || text === null){
                $("#Valid").html("<span>This field is required</span>");
                return false;
            } else {
                $("#Valid").html("");
            }


         $("#AdminDetailssettings").validate({

            rules: {
              user: {
                required: true,

              },
               name: {
                required: false,

              },
               status: {
                    required: true,
                    statusActiveInactive:true,
                },
           

              },
              //For custom messages
              messages: {

              },
              errorElement : 'div',
              errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                  $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }

          });
    });



});




//Contact Details setting form Validate

$(document).ready(function(){

    $("#contactDetailssubmit").click( function(e) {
        var text = tinyMCE.activeEditor.getContent();
        if(text === "" || text === null){
            $("#Valid").html("<span>This field is required</span>");
            return false;
        } else {
            $("#Valid").html("");
        }
   });


});


 
$("#ContactDetailssettings").validate({
  
  submitHandler: function(form) {
    form.submit();
  },
  ignore: [],
  rules: {
    'statussocial[]': {
      required: true
    },
     'name[]': {
     required: true,
    },
    'socialUrl[]': {
     required: true,
    },
    title: {
    required: true,
    },

    map: {
    required: true,
   },
     status: {
        required: true,
        statusActiveInactive:true,
    },
    mytextarea: {
        required: true,
    },
 

  },

   errorElement : 'div',
      errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
          $(placement).append(error)
        } else {
            error.insertAfter(element);
        }
    },
    


});