@extends('layouts.app')

@section('content')

<img id="barcode" src="https://chart.googleapis.com/chart?cht=qr&chl=asdfasdf&chs=180x180&choe=UTF-8&chld=L|2alt=" />
       <br/>
       <input id="btn-readBarcode" type="button" value="Read Barcode" onclick="ReadBarcode();" />
       <script type="text/javascript">
           var dbrObject;
           function onDBRInitSuccess() {
               dbrObject = new dynamsoft.dbrEnv.BarcodeReader();
           }
           function onDBRInitFailure(errorCode, errorString) {
               alert('Init failed: ' + errorString);
           }
           dynamsoft.dbrEnv.init(onDBRInitSuccess, onDBRInitFailure);

           function ReadBarcode(){
               if (!dbrObject) return;

               var base64img = document.getElementById("barcode").src.split(',')[1];

               var result = dbrObject.readBase64(base64img);
               if(result.getCount() > 0) {
                   var strMsg = "Barcode Type: " + result.get(0).formatString + "\n";
                   strMsg += "Barcode Value: " + result.get(0).text;
                   alert(strMsg);
               } else {
                   alert("No barcode(s) found.");
               }
           }
       </script>
@endsection
