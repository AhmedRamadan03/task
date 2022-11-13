<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal  fade form-modal " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered">
        <div class="modal-content"style="border-radius: 12px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                   
                        uploade file
                </h5>
              
                    <button type="button" class="btn"style=" "  data-bs-dismiss="modal" aria-label="Close">x</button>
                

            </div>
            <form action="{{ route('folders.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @if (auth()->user()->is_admin == '1')
                    <div class="form-group">
                        {!! Form::select('user_id', $users, request()->user_id, ["class"=> 'form-control form-select' , "placeholder"=>'select user']) !!}
                    </div>
                    @else
                    {!! Form::hidden('user_id',auth()->user()->id) !!}
                    @endif
                    {!! Form::file('file', ["class" => 'form-control' , 'accept'=>'zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed']) !!}


                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w3-block p-2 w3-text-white">
                            Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
