<div class="container-fluid">
    <div class="row bg-dark text-white">
        <div class="col-6 p-3">
            [APLICAÇÃO]
        </div>
        <div class="col p-3 text-right">
            {{ session('user')['name'] }} | <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
</div>
