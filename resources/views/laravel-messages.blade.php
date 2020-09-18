<div class="container">
    @if(Session::has('success'))
        <x-alert type="success" :dismissable="true"><em>{{session('success')}}</em></x-alert>
    @endif

    @if(Session::has('warning'))
        <x-alert type="warning" :dismissable="true"><em>{{session('warning')}}</em></x-alert>
    @endif

    @if(Session::has('error'))
        <x-alert type="danger" :dismissable="true"><em>{{session('error')}}</em></x-alert>
    @endif

    @if(count($errors) > 0)
        <x-alert type="danger" :dismissable="true">
            <ul style="margin-bottom: 0">
                @foreach (array_unique($errors->all()) as $error)
                    <li>{!!  $error  !!}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif
</div>
