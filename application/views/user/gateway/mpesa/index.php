<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title>T4T M-Pesa Payment</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/style-main.css">
    </head>
    <body style="background: #ededed;">
        <div class="container">
            <div class="row">
                <div class="paddtop20">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <img src="<?php echo base_url('uploads/school_content/logo/' . $setting[0]['image']);  ?>">
                    </div>
                    <div class="col-md-6 col-md-offset-3 mt20">
                        <div class="paymentbg">
                            <div class="invtext">M-Pesa Contribution Payment</div>
                            <br>
                            <div class="padd2 paddtzero">
                                <form action="<?php echo base_url(); ?>user/gateway/mpesa/stk_push" method="post">
                                <table class="table2" width="100%">
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                    <tr>
                                        <td>Contribution Total</td>
                                        <td class="text-right"><?php echo $setting[0]['currency_symbol'] . amountFormat($params['total']); ?></td>
                                    </tr>
                                    <tr class="bordertoplightgray">
                                        <td bgcolor="#fff">M-Pesa Phone Number:</td>
                                        <td bgcolor="#fff" class="text-right"> <input type="text" class="form-control" name="phone" placeholder="2547XXXXXXXX" value="<?php echo $params['guardian_phone'];?>" /></td>
                                    </tr>
                                    <tr class="bordertoplightgray">
                                        <td bgcolor="#fff"><button type="button" onclick="window.history.go(-1); return false;" class="btn btn-info"><i class="fa fa fa-chevron-left"></i> Back</button></td>
                                        <td bgcolor="#fff" class="text-right"> <button type="submit" class="btn btn-info">Pay with M-Pesa <i class="fa fa-chevron-right"></i></button></td>
                                    </tr>
                                </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
