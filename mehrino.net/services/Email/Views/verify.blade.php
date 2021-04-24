<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .btn {
            ont-weight: 500;
            outline: 0 !important;
        }

        .btn-lg {
            padding: .75rem 1.5rem;
            font-size: 1.25rem;
            border-radius: .3rem;
        }

        .btn-success {
            color: #fff;
            background-color: #5cb85c;
            border-color: #5cb85c;
        }

        .clear {
            clear: both;
        }

        .center {
            text-align: center;
        }

        .display-block {
            display: inline-block;
        }

        .no-under {
            text-decoration: none;
        }

        .margin {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="center">
        <div>
            <h2>
                به مهرینو
                خوش آمدید. برای تایید ایمیل لطفا کد زیر را وارد کنید
            </h2>

            <br class="clear">
            <h2> {{$code}}</h2>
        </div>
        <p>
            <span>نیاز به راهنمایی دارید؟
            </span>
            <br>
            <br>
            <br>
            <span>
                .با ایمیل زیر در ارتباط باشید
            </span>

            <br>
            <br>
            <br>
            <span>
                <a href="mailto:support@mehrino.ac">support@mehrino.ac</a>
            </span>
        </p>

    </div>
</body>

</html>
