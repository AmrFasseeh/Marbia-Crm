{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Leads View')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('/css/pages/page-users.css')}}">
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }
</style>
@endsection

{{-- page content  --}}
@section('content')
<!-- users view start -->
<div class="section users-view">
    <!-- users view media object start -->
    <div class="card-panel">
        <div class="row">
            <div class="col s12 m7">
                <div class="display-flex media">
                    <a href="#" class="avatar">
                        <img src="{{ isset($lead->image) ? $lead->image->url():asset('/images/avatar/default.png') }}"
                            alt="users view avatar" class="z-depth-4 circle" height="64" width="64">
                    </a>
                    <div class="media-body">
                        <h6 class="media-heading">
                            <span class="users-view-name">{{ $lead->fullname }}</span>
                            <span class="grey-text"></span>
                            <span class="users-view-username grey-text">{{ $lead->job_title }}</span>
                        </h6>
                        <span>ID:</span>
                        <span class="users-view-id">{{ $lead->id }}</span>
                    </div>
                </div>
            </div>
            <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                @if($lead->lead_stage_id != 7)
                <a class="btn-small green" href="{{ route('won.lead', $lead->id) }}">won</a>
                @else
                <a class="btn-small green" href="#">Won&#10004;</a>
                @endif

                @if ($lead->lead_stage_id != 6)
                <a class="btn-small red" href="{{ route('lost.lead', $lead->id) }}">lost</a>
                @else
                <a class="btn-small red" href="#">Lost&#10004;</a>
                @endif

                <form id="delete_lead" action="{{ route('delete.lead', $lead->id) }}" method="post">
                    @csrf
                    <a class="btn-small btn-light-red" onclick="deleteLead()"><i
                            class="material-icons">delete</i></a></form>
                <a href="{{ route('edit.lead', $lead->id) }}" class="btn-small indigo">Edit</a>
            </div>
        </div>
    </div>
    <!-- users view media object ends -->
    <!-- users view card data start -->
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m6">
                    <h6 class="mb-2 mt-2"><i class="material-icons">contact_phone</i> Lead Details</h6>
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Lead Title:</td>
                                <td>{{ $lead->lead_title }}</td>
                            </tr>
                            <tr>
                                <td>Lead Source:</td>
                                <td class="users-view-latest-activity">{{ $lead->lead_source }}</td>
                            </tr>
                            <tr>
                                <td>Due date:</td>
                                <td class="users-view-role">
                                    {{ Carbon\Carbon::make($lead->lead_date)->toFormattedDateString() }}</td>
                            </tr>
                            <tr>
                                <td>Lead Quality:</td>
                                <td class="users-view-role">
                                    <div id="rate" class="rate">
                                        <input type="radio" id="star5" name="lead_value" value="5" {{ $lead->lead_value >= 5 ? 'checked' : '' }} disabled/>
                                        <label for="star5" title="5">5 stars</label>
                                        <input type="radio" id="star4" name="lead_value" value="4" disabled {{ $lead->lead_value == 4 ? 'checked' : '' }}/>
                                        <label for="star4" title="4">4 stars</label>
                                        <input type="radio" id="star3" name="lead_value" value="3" disabled {{ $lead->lead_value == 3 ? 'checked' : '' }}/>
                                        <label for="star3" title="3">3 stars</label>
                                        <input type="radio" id="star2" name="lead_value" value="2" disabled {{ $lead->lead_value == 2 ? 'checked' : '' }}/>
                                        <label for="star2" title="2">2 stars</label>
                                        <input type="radio" id="star1" name="lead_value" value="1" disabled {{ $lead->lead_value == 1 ? 'checked' : '' }}/>
                                        <label for="star1" title="1">1 star</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Lead Stage:</td>
                                <td class="users-view-role">
                                    {{ $stage->title }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 m6">
                    <h6 class="mb-2 mt-2"><i class="material-icons">contacts</i> Contact Details</h6>
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Name:</td>
                                <td class="users-view-username">{{ $lead->fullname }}</td>
                            </tr>
                            <tr>
                                <td>Job title:</td>
                                <td class="users-view-name">{{ $lead->job_title }}</td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td class="users-view-email">{{ $lead->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>{{ $lead->phone }}</td>
                            </tr>
                            <tr>
                                <td>Birthday:</td>
                                <td>{{ $lead->date_birth }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m6">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Added:</td>
                                <td>{{ $lead->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Latest Edit:</td>
                                <td class="users-view-latest-activity">{{ $lead->updated_at }}</td>
                            </tr>
                            <tr>
                                <td>Agent:</td>
                                <td class="users-view-role">
                                    {{ $lead->user->fullname() }}</td>
                            </tr>
                            <tr>
                                <td>Type:</td>
                                <td class="users-view-role">
                                    @if ($lead->type === 0)
                                    Contact
                                    @elseif ($lead->type === 1)
                                    Lead
                                    @elseif ($lead->type === 2)
                                    Customer
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 m6">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Country:</td>
                                <td>{{ $country }}</td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td>{{ $city }}</td>
                            </tr>
                            <tr>
                                <td>District:</td>
                                <td>{{ $district }}</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td>{{ $lead->address }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- users view card data ends -->

    <!-- users view card details start -->
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <table class="striped">

                    </table>
                    <h6 class="mb-2 mt-2"><i class="material-icons">link</i> Social Links</h6>
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Twitter:</td>
                                <td><a href="{{ $lead->twitter }}">{{ $lead->twitter }}</a></td>
                            </tr>
                            <tr>
                                <td>Facebook:</td>
                                <td><a href="{{ $lead->facebook }}">{{ $lead->facebook }}</a></td>
                            </tr>
                            <tr>
                                <td>Skype:</td>
                                <td><a href="#">{{ $lead->skype }}</a></td>
                            </tr>
                            <tr>
                                <td>Linkedin:</td>
                                <td><a href="{{ $lead->linkedin }}">{{ $lead->linkedin }}</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s6">
                    <h6 class="mb-2 mt-2"><i class="material-icons">comment</i> Add a Comment</h6>
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <form class="col s12"
                                    action="{{ route('store.leadcomment', ['lead'=>$lead, 'user'=>Auth::user()->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea id="textarea2" class="materialize-textarea" name="message"
                                                placeholder="Your Comment.."></textarea>
                                            <button type="submit"
                                                class="waves-effect waves-light indigo btn">submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
    <!-- users view card details ends -->
    {{-- comments section --}}
    <div class="card">
        <div class="card-content">
            <h6 class="mb-2 mt-2"><i class="material-icons">comment</i> Comments</h6>
            <div class="row">
                @foreach ($lead->comments->sortKeysDesc() as $comment)
                <div class="col s12">
                    <div class="card blue lighten-5">
                        <div class="card-content">
                            <span class="card-title"><img
                                    src="{{ isset($lead->image) ? $lead->image->url():asset('/images/avatar/default.png') }}"
                                    alt="users view avatar" class="z-depth-4 circle" height="32" width="32"><span
                                    class="red-text"> {{ $comment->user->fullname() }}</span>
                                <span class="ml-2"><button class="btn-floating red"
                                        onclick="deleteCommentPrompt({{ $comment->id }})"><i
                                            class="material-icons">delete</i></button>
                                    <form id="delete-comment-{{ $comment->id }}"
                                        action="{{ route('delete.comment', $comment->id) }}" method="POST" hidden>
                                        @csrf</form>
                                </span></span>
                            <hr>
                            <p style="text-indent: 20px">{{ $comment->message }}</p>
                            <br>
                            <small><i class="material-icons">access_time</i>
                                {{ Carbon\Carbon::make($comment->created_at)->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- users view ends -->
@endsection


@section('vendor-script')
<script src="{{asset('/vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

@section('page-script')
{{-- <script src="{{asset('/js/scripts/page-users.js')}}"></script> --}}
<script>
    function deleteLead(){
        swal({
			title: "Are you sure you want to delete this lead?",
			icon: 'warning',
			dangerMode: true,
			buttons: {
				cancel: 'No, Please!',
				delete: 'Yes, Delete It'
			}
		}).then(function (willDelete) {
			if (willDelete) {
                $('#delete_lead').submit()
				swal("This lead was deleted!", {
					icon: "success",
				});
			} else {
				swal("This lead is safe", {
					title: 'Cancelled',
					icon: "error",
				});
			}
		});
    }
    
    function deleteCommentPrompt(id){
        swal({
			title: "Are you sure you want to delete this comment?",
			icon: 'warning',
			dangerMode: true,
			buttons: {
				cancel: 'No, Please!',
				delete: 'Yes, Delete It'
			}
		}).then(function (willDelete) {
			if (willDelete) {
                $('#delete-comment-'+id).submit();
				swal("Your comment was deleted!", {
					icon: "success",
				});
			} else {
				swal("Your comment is safe", {
					title: 'Cancelled',
					icon: "error",
				});
			}
		});
    }
</script>
@endsection