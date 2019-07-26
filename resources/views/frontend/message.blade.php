@if(session('status'))
    <div class="alert alert-success alert-dismissible fade show flash">
        {{session('status')}}
        <button type="button" class="close">
            <span aria-hidden="true">
                &times
            </span>
        </button>
    </div>
@endif