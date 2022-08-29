<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Message</title>
    <style>








        
    </style>
</head>
<body>


<!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
              <div class="col s12 mt-5">
                <!-- message  -->
                <div class="container">
                    <div class="row">
                        <div class="col m12 s12">
                            <div style="width: 80%;margin: 0 auto;">
                              <div class="card-content p-5">
                                      <h4 style="text-align:center;font-size: 23px; font-weight: 600;color: black;text-transform: uppercase;font-family: sans-serif;" class="fs-md-1 msg">{{$name}}-Information</h4>
                                      <table style="width: 100%;border: 1px solid black;border-collapse: collapse;" class="table table-bordered">
                                        <thead>
                                          <tr >
                                                <th style="border: 1px solid black;padding: 15px;">Name : {{$name}}</th>
                                                <th style="border: 1px solid black;padding: 15px;">Email : {{$email}}</th>
                                                <th style="border: 1px solid black;padding: 15px;">Mobile : {{$mobile}}</th>
                                                <th style="border: 1px solid black;padding: 15px;">IP : {{$ip}}</th>
                                                <th style="border: 1px solid black;padding: 15px;">Country : {{$country}}</th>
                                                <th style="border: 1px solid black;padding: 15px;">City : {{$city}}</th>
                                                <th style="border: 1px solid black;padding: 15px;">Device : {{$device}}</th>
                                             

                                                
                                          </tr>
                                          <tr>
                                            <th style="border: 1px solid black;padding: 15px;">Message:-</th>
                                            <th style="border: 1px solid black;padding: 15px;" colspan="7">
                                                  {{$text}}
                                            </th>
                                         </tr>

                                        </thead>
                                  
                                      </table>
                              </div>
                            </div>
                        </div>

                

                    </div> 
                </div>
                <!-- message  End-->
              </div>

              
        </div>
    </div>
      <!-- END: Page Main-->



</body>
</html>