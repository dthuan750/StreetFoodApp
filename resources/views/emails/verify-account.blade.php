<h3>Hi: {{$account->name}}</h3>
<p>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. In adipisci ad commodi consequuntur doloribus magni, non nesciunt voluptate fugit dolorem est quidem minus deserunt reiciendis, quia voluptas, delectus natus quibusdam.
</p>


<p>
    <a href="{{route('account.verify', $account->email)}}">Click here to verify your account</a>
</p>