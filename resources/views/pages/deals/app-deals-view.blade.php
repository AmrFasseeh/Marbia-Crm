{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Deals View')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('/css/pages/page-users.css')}}">
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
                    {{-- <a href="#" class="avatar">
                        <img src="{{ isset($deal->image) ? $deal->image->url():asset('/images/avatar/default.png') }}"
                    alt="users view avatar" class="z-depth-4 circle" height="64" width="64">
                    </a> --}}
                    <div class="media-body">
                        <h6 class="media-heading">
                            <span class="users-view-name">{{ $deal->title }}</span>
                            <span class="grey-text"></span>
                            <span class="users-view-username grey-text">{{ $deal->customer->fullname }}</span>
                        </h6>
                        <span>Agent:</span>
                        <span class="users-view-id">{{ $deal->user->fullname() }}</span>
                    </div>
                </div>
            </div>
            <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                @if ($deal->deal_stages_id != 5)
                <a class="btn-small green" href="{{ route('won.deal', $deal->id) }}">Confirm</a>
                @else
                <a class="btn-small green" href="#">Confirmed</a>
                @endif

                <a class="btn-small btn-light-blue" href="{{ route('edit.deal', $deal->id) }}"><i
                        class="material-icons">edit</i></a>
                <form id="delete_deal" action="{{ route('delete.deal', $deal->id) }}" method="GET">
                    @csrf
                    <a class="btn-small btn-light-red" onclick="deletePrompt()"><i class="material-icons">delete</i></a>
                </form>
                {{-- <a href="{{ route('edit.deal', $deal->id) }}" class="btn-small indigo">Edit</a> --}}
            </div>
        </div>
    </div>
    <!-- users view media object ends -->
    <!-- users view card data start -->
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m6">
                    <h6 class="mb-2 mt-2"><i class="material-icons">contact_phone</i> Deal Info</h6>
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Deal Title:</td>
                                <td>{{ $deal->title }}</td>
                            </tr>
                            <tr>
                                <td>Deal Source:</td>
                                <td class="users-view-latest-activity">{{ ucfirst($deal->source) }}</td>
                            </tr>
                            <tr>
                                <td>Deal age:</td>
                                <td class="users-view-role">
                                    {{ Carbon\Carbon::make($deal->created_at)->diffForHumans() }}</td>
                            </tr>
                            <tr>
                                <td>Due date:</td>
                                <td class="users-view-role">
                                    {{ Carbon\Carbon::make($deal->due_date)->toFormattedDateString() }}</td>
                            </tr>
                            <tr>
                                <td>Deal Stage:</td>
                                <td class="users-view-role">
                                    {{ $stage->title }}
                                </td>
                            </tr>
                            @if ($deal->payment == 'cash')
                            <tr>
                                <td>Payment Method:</td>
                                <td class="users-view-role">
                                    Cash
                                </td>
                            </tr>
                            <tr>
                                <td>Down Payment:</td>
                                <td class="users-view-role">
                                    {{ $down_payment .' '. $deal->currency }}
                                </td>
                            </tr>
                            <tr>
                                <td>Value:</td>
                                <td class="users-view-role">
                                    {{ $value .' '. $deal->currency }}
                                </td>
                            </tr>
                            <tr>
                                <td>Value After Discount:</td>
                                <td class="users-view-role">
                                    {{ $final_value .' '. $deal->currency }}
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>Payment Method:</td>
                                <td class="users-view-role">
                                    Installments on {{ $deal_months }} months
                                </td>
                            </tr>
                            <tr>
                                <td>Down Payment:</td>
                                <td class="users-view-role">
                                    {{ $down_payment .' '. $deal->currency }}
                                </td>
                            </tr>
                            <tr>
                                <td>Value After Discount:</td>
                                <td class="users-view-role">
                                    {{ $final_value .' '. $deal->currency }}
                                </td>
                            </tr>
                            <tr>
                                <td>Installments:</td>
                                <td class="users-view-role">
                                    {{ $installments .' '. $deal->currency .' '. $rate }}
                                </td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="col s12 m6">
                    <h6 class="mb-2 mt-2"><i class="material-icons">contacts</i> Customer Info</h6>
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Customer Name:</td>
                                <td class="users-view-username">{{ $deal->customer->fullname }}</td>
                            </tr>
                            <tr>
                                <td>Job title:</td>
                                <td class="users-view-name">{{ $deal->customer->job_title }}</td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td class="users-view-email">{{ $deal->customer->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>{{ $deal->customer->phone }}</td>
                            </tr>
                            {{-- <tr>
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
                            </tr> --}}
                            <tr>
                                <td>Address:</td>
                                <td>{{ $deal->customer->address }}</td>
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
                    <h6 class="mb-2 mt-2"><i class="material-icons">location_on</i> Property Info</h6>
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Property Title:</td>
                                <td>{{ $deal->property->name }}</td>
                            </tr>
                            <tr>
                                <td>Info:</td>
                                <td class="users-view-latest-activity">
                                    {{ $deal->property->building->buildingGroup->project->title }},
                                    {{ $deal->property->building->buildingGroup->title }},
                                    {{ $deal->property->building->building_name }}</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td class="users-view-role">
                                    {{ $district. ', '.$city.', '.$country }}</td>
                            </tr>
                            <tr>
                                <td>Type:</td>
                                <td class="users-view-role">
                                    {{ $deal->property->property_type }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 m6 mt-4">
                    <table class="striped">
                        <tbody>
                            <tr>
                                <td>Floor #:</td>
                                <td class="users-view-role">
                                    {{ $deal->property->floor_no }}</td>
                            </tr>
                            <tr>
                                <td>Appartment #:</td>
                                <td class="users-view-role">
                                    {{ $deal->property->apartment_no }}</td>
                            </tr>
                            <tr>
                                <td>Area(Sqm):</td>
                                <td class="users-view-role">
                                    {{ $deal->property->area_sqm }}
                                </td>
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
                <div class="col s12">
                    <h6 class="mb-2 mt-2"><i class="material-icons">comment</i> Add a Comment</h6>
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <form class="col s12"
                                    action="{{ route('store.dealcomment', ['deal'=>$deal, 'user'=>Auth::user()->id]) }}"
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
                @foreach ($deal->comments->sortKeysDesc() as $comment)
                <div class="col s12">
                    <div class="card blue lighten-5">
                        <div class="card-content">
                            <span class="card-title"><img
                                    src="{{ isset($deal->image) ? $deal->image->url():asset('/images/avatar/default.png') }}"
                                    alt="users view avatar" class="z-depth-4 circle" height="32" width="32"><span
                                    class="red-text"> {{ $comment->user->fullname() }}</span><span class="ml-2"><button
                                        class="btn-floating red" onclick="deleteCommentPrompt({{ $comment->id }})"><i
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
{{-- page script --}}
@section('page-script')
{{-- <script src="{{asset('/js/custom/deals-view.js')}}"></script> --}}
<script>
    function deletePrompt(){
        swal({
			title: "Are you sure you want to delete?",
			icon: 'warning',
			dangerMode: true,
			buttons: {
				cancel: 'No, Please!',
				delete: 'Yes, Delete It'
			}
		}).then(function (willDelete) {
			if (willDelete) {
                $('#delete_deal').submit();
				swal("Your Deal was deleted!", {
					icon: "success",
				});
			} else {
				swal("Your Deal is safe", {
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