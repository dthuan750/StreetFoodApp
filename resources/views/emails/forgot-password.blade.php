<div style="border: 3px solid green; padding: 15px; background: lightgreen; width: 600px; margin: auto;">
    <h3>Hi {{$customer->name}}</h3>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus aspernatur id amet facere! Mollitia facere, dicta, pariatur incidunt praesentium aliquam voluptas similique nemo reiciendis repellat eligendi nisi in quis dolorem.</p>

    <p>
        <a href="{{route('account.reset_password', $token)}}" style="display: inline-block; padding: 7px 25px; color: #fff; background: darkblue;">Click here to get new password</a>
    </p>

</div>