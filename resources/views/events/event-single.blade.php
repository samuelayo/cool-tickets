@extends('coolbase')
@section('content')
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token()
        ]); ?>

    </script>
    <?php
    if(auth()->user()){
    ?>
    <script>
        localStorage.setItem('username', '<?php echo auth()->user()->name ?>');
        localStorage.setItem('email', '<?php echo auth()->user()->email ?>');
    </script>
    <?php
    }
    ?>

    <?php
    if(!auth()->user()){
    ?>
    <script>
        if (localStorage.getItem('username') !== undefined) {
            localStorage.removeItem('username');
            localStorage.removeItem('email');
        }
    </script>
    <?php
    }
    ?>
<events-inner name="{{$name}}"></events-inner>

@endsection