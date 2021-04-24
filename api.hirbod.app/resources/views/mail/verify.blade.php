<!DOCTYPE html>
<html lang="en">
<head>


    <style>

        .btn{
            ont-weight: 500;
            outline: 0 !important;
        }
        .btn-lg{
            padding: .75rem 1.5rem;
            font-size: 1.25rem;
            border-radius: .3rem;
        }
        .btn-success{
            color: #fff;
            background-color: #5cb85c;
            border-color: #5cb85c;
        }
        .clear{
            clear: both;
        }
        .center{
            text-align: center;
        }
        .display-block{
            display: inline-block;
        }
        .no-under{
            text-decoration: none;
        }
        .margin{
            margin-top: 30px;
        }

    </style>


</head>

<body>


<div class="center">


    <div>
        <br>
        <br>
        <img src="{{asset('assets/image/hirbod.png')}}">

        <h4>
            .عزیز به هیربد خوش آمدید. برای تایید ایمیل لطفا بر روی دکمه زیر کلیک کنید{{$user['name']}}
        </h4>

        <br class="clear">
        <a class="margin btn btn-success btn-lg display-block no-under" href="{{route('callback.verify.email',['email'=>Illuminate\Support\Facades\Crypt::encrypt($user['email'])])}}" >فعال سازی</a>


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
            <a href="mailto:support@hirbodapp.ir">support@hirbodapp.ir</a>
        </span>
    </p>

</div>

</body>



</html>
