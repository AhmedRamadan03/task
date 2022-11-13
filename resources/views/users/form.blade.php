<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal  fade form-modal " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered">
        <div class="modal-content"style="border-radius: 12px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @if ($resource->id)
                       Edit User
                    @else
                        Add User
                    @endif
                </h5>
                @if ($resource->id)
                    <a href="{{ route('users.index') }}" style=" " class="btn">x</a>
                @else
                    <button type="button" class="btn"style=" "  data-bs-dismiss="modal" aria-label="Close">x</button>
                @endif

            </div>
            <form action="{{ $resource->id ? route('users.update', $resource->id) : route('users.store') }}"
                method="post">
                @csrf
                {{-- {!! Form::hidden('id', $resource->id, []) !!} --}}
                <div class="modal-body">
                        <div class="form-group">
                            <label for="#username">Username</label>
                            {!! Form::text('username', old('username',$resource->username), ["class" => 'form-control' , "placeholder" => 'username' , 'required', 'id' =>'username']) !!}
                        </div>
                        <div class="form-group">
                            <label for="#password">Password</label>
                            {!! Form::password('password',  ["class" => 'form-control' , "placeholder" => 'password' , 'id' =>'password']) !!}
                        </div>
                        <div class="form-group">
                            <label for="#confirm">confirm password</label>
                            {!! Form::password('confirm_password',  ["class" => 'form-control' , "placeholder" => 'confirm password' , 'id' =>'confirm']) !!}
                        </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w3-block p-2 w3-text-white">
                        @if ($resource->id)
                           Update
                        @else
                            Save
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
