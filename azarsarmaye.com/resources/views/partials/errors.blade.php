@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('message'))
    <div class="alert alert-info">
        <ul>
            <li>{{session()->pull('message')}}</li>
        </ul>
    </div>
@endif
