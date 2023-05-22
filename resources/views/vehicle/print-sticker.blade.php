
   <body onload="window.print()">
   <style>
       @media print {
           .print-style {
               position: absolute;
               top: 50%;
               left: 15%;
               transform: translate(-30%, -30%);
               

           }
       }

   </style>
   <div class="" align="center" >
       @php
           $dns2d = new Milon\Barcode\DNS2D;

       @endphp
       <div id="qr-code-sticker">
           <img src="{{asset('img/sticker-vims.png')}}" width="70%" height="auto">
           <div class="print-style" style="margin-top: -400px; margin-left: 400px">
               {!! DNS2D::getBarcodeHTML($vehicleInfoForQR, 'QRCODE', 7, 7) !!}
           </div>
       </div>
   </div>
   </body>



