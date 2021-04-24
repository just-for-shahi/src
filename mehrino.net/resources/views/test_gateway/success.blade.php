<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>پرداخت</title>
    <link rel="stylesheet" href="https://cdn.pay.ir/v1/fonts/font.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <style>

        * {
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }

        body {
            background-color: #f1f2f5;
            direction: rtl;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            font-family: vazir, serif;
        }

        p {
            margin-bottom: 45px;
            color: #2a2a2a;
            font-size: 20px;
            font-family: vazirMedium, serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-family: vazirMedium, serif;
            font-size: 34px;
        }

        /*.btn {*/
        /*    box-shadow: none;*/
        /*    border: none;*/
        /*    height: 40px;*/
        /*    padding: 0 15px;*/
        /*    border-radius: 5px;*/
        /*    color: #fff;*/
        /*    cursor: pointer;*/
        /*    font-size: 14px;*/
        /*    transition: all 0.3s ease-in-out;*/
        /*    position: relative;*/
        /*    overflow: hidden;*/
        /*    background-color: #5098ef;*/
        /*    display: inline-block;*/
        /*    line-height: 40px;*/
        /*    font-family: vazir, serif;*/
        /*}*/

        /*.btn:hover {*/
        /*    background-color: #3e8ae6;*/
        /*}*/

        /*.btn:focus {*/
        /*    outline: none*/
        /*}*/

        /*.btn.fail {*/
        /*    background: #ef5050;*/
        /*}*/

        /*.btn.fail:hover {*/
        /*    background: #cd4545;*/
        /*}*/

        .card-center {
            border-radius: 8px;
            border: 2px solid #aaa;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-7 col-lg-4">
            <div class="card card-center">
                <div class="card-header bg-success">
                    <p class="text-light p-0 m-0" style="font-size: 16px">پرداخت شما با موفقیت انجام شد</p>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered border-secondary mb-0">
                            <tbody>
                            <tr>
                                <td>مقدار</td>
                                <td>
                                    <span>{{ $transaction->amount }}</span>
                                    <span>تومان</span>
                                </td>
                            </tr>
                            <tr>
                                <td>شماره کارت</td>
                                <td dir="ltr">{{ $transaction->card_number }}</td>
                            </tr>
                            <tr>
                                <td>توضیحات</td>
                                <td>{{ $transaction->description }}</td>
                            </tr>
                            <tr>
                                <td>کد پیگیری</td>
                                <td>{{ $transaction->trace_number }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="https://mno.ac/pg" class="btn btn-block btn-primary text-light" style="font-size: 14px">بازگشت به اپلیکیشن</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
