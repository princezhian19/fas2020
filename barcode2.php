<style type="text/css">
	 @media print {
       
        .page {
            width: 21cm;
            height: 29.7cm;
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
              }
             .col-print-12 {
            width: 100%;
             }
              }
</style>
<script src="https://cdn.jsdelivr.net/jsbarcode/3.3.7/JsBarcode.all.min.js"></script>
<div class="col-12 col-print-12">

            	<h1>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspDILG IV - A ICS</h1>
            <p class="barcode tekli">
                <svg id="barcode"></svg>
            </p>

        </div>

        <?php 
$id = $_GET['id'];
    $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
    $query = mysqli_query($conn,"SELECT * FROM rpcppe WHERE id = '$id'");
    $row = mysqli_fetch_array($query);
    $pn = $row['property_number'];

    $pn1 = str_replace(' ', '', $pn);

    $pn2 = strtolower($pn1);



         ?>

<script type="text/javascript">
	JsBarcode("#barcode", "<?php echo $pn2?>",{
    width:5,
        height:200,
    fontSize:50,
    displayValue: true

});

window.print();

window.open('', '_parent', '');

window.close();
</script>

<div hidden>
<div style='text-align: center;'>
  <!-- insert your custom barcode setting your data in the GET parameter "data" -->
  <?php $barcode = 'charlesodi231' ?>
  <p style="padding-bottom: 0px;">DILG IV-A ICS</p>
  <img alt='Barcode Generator TEC-IT'
       src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $barcode;?>&code=Code128&dpi=96&dataseparator='/>
</div>
<div style='padding-top:8px; text-align:center; font-size:15px; font-family: Source Sans Pro, Arial, sans-serif;'>
  <!-- back-linking to www.tec-it.com is required -->
    <!-- logos are optional -->
  </a>
</div>
</div>