<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
  <!--  All snippets are MIT license http://bootdey.com/license -->
  <title>CRUD users - Bootdey.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <div class="container">
    <div class="row flex-lg-nowrap">
      <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
        <div class="card p-3">
          <div class="e-navlist e-navlist--active-bg">
            <ul class="nav">
              <li class="nav-item"><a class="nav-link px-2 active" href="{{ route('profile') }}"><i class="fa fa-fw fa-bar-chart mr-1"></i><span>Profile</span></a></li>
              <li class="nav-item"><a class="nav-link px-2" href="{{ route('dashboard') }}"><i class="fa fa-fw fa-th mr-1"></i><span>User CRUD</span></a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="e-tabs mb-3 px-3">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" href="#">Users</a></li>
          </ul>
        </div>

        <div class="row flex-lg-nowrap">
          <div class="col mb-3">
            <div class="e-panel card">
              <div class="card-body">
                <div class="card-title">
                  <h6 class="mr-2"><span>Users</span><small class="px-1">Be a wise leader</small></h6>
                </div>
                <div class="e-table">
                  <div class="table-responsive table-lg mt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="align-top">
                            <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                              <input type="checkbox" class="custom-control-input" id="all-items">
                              <label class="custom-control-label" for="all-items"></label>
                            </div>
                          </th>
                          <th>Photo</th>
                          <th class="max-width">Name</th>
                          <th class="sortable">Date</th>
                          <th> </th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($allUser as $singleUser)
                        <tr>
                          <td class="align-middle">
                            <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                              <input type="checkbox" class="custom-control-input" id="item-1">
                              <label class="custom-control-label" for="item-1"></label>
                            </div>
                          </td>
                          <td class="align-middle text-center">
                            <div class="bg-light d-inline-flex justify-content-center align-items-center align-top" style="width: 35px; height: 35px; border-radius: 3px;"><img class="w-100 h-100" src="{{url('/uploads/'.$singleUser['profile_image'])}}" alt="" srcset=""></div>
                          </td>
                          <td class="text-nowrap align-middle">{{$singleUser['fullname']}}</td>
                          <td class="text-nowrap align-middle"><span>{{strtok($singleUser['created_at'],'T')}}</span></td>
                          <td class="text-center align-middle"><i class="fa fa-fw text-secondary cursor-pointer fa-toggle-on"></i></td>
                          <td class="text-center align-middle">
                            <div class="btn-group align-top">
                              <button class="btn btn-sm btn-outline-secondary badge" type="button">View</button>
                              <button class="btn btn-sm btn-outline-secondary badge" type="button" data-toggle="modal" data-target="#{{$singleUser['id']}}">Edit</button>
                              <button class="btn btn-sm btn-outline-secondary badge" type="button"><a href="{{ route('profile-destroy',$singleUser['id']) }}"><i class="fa fa-trash"></a></i></button>
                            </div>
                          </td>
                        </tr>
                        <!-- User Form Modal -->
                        <div class="modal fade" role="dialog" tabindex="-1" id="{{$singleUser['id']}}">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="py-1">
                                  <form class="form" action="{{ route('profile-change', $singleUser['id']) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                      <div class="col">
                                        <div class="row">
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Full Name</label>
                                              <input class="form-control" type="text" name="fullname" placeholder="John Smith" value="{{$singleUser['fullname']}}">
                                            </div>
                                          </div>
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Username</label>
                                              <input class="form-control" type="text" name="username" placeholder="johnny.s" value="{{$singleUser['username']}}">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Email</label>
                                              <input class="form-control" name="email" value="{{$singleUser['email']}}" type="text" placeholder="user@example.com">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col mb-3">
                                            <div class="form-group">
                                              <label>About</label>
                                              <textarea class="form-control" rows="5" name="bio" placeholder="My Bio">{{$singleUser['bio']}}</textarea>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-12 col-sm-6 mb-3">
                                        <div class="mb-2"><b>Confirm your Password for make change</b></div>
                                        <div class="row">
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Your Password</label>
                                              <input required class="form-control" name="password" type="password" placeholder="••••••">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col d-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit">Save Changes</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex justify-content-center">
                    <ul class="pagination mt-3 mb-0">
                      <li class="disabled page-item"><a href="#" class="page-link">‹</a></li>
                      <li class="active page-item"><a href="#" class="page-link">1</a></li>
                      <li class="page-item"><a href="#" class="page-link">2</a></li>
                      <li class="page-item"><a href="#" class="page-link">3</a></li>
                      <li class="page-item"><a href="#" class="page-link">4</a></li>
                      <li class="page-item"><a href="#" class="page-link">5</a></li>
                      <li class="page-item"><a href="#" class="page-link">›</a></li>
                      <li class="page-item"><a href="#" class="page-link">»</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-3 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="text-center px-xl-3">
                  <button class="btn btn-success btn-block" type="button" data-toggle="modal" data-target="#user-form-modal">New User</button>
                </div>
                <!-- User create model -->
                <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">User Create</h5>
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row justify-content-center">
                          <div class="col-md-12">
                            <div class="card">
                              <h3 class="card-header text-center">Register User</h3>
                              <div class="card-body">
                                <form action="{{ route('register.custom') }}" method="POST">
                                  @csrf
                                  <div class="form-group mb-3">
                                    <input type="text" placeholder="Full Name" id="fullname" class="form-control" name="fullname" required autofocus>
                                    @if ($errors->has('fullname'))
                                    <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                    @endif
                                  </div>

                                  <div class="form-group mb-3">
                                    <input type="text" placeholder="Userame" id="username" class="form-control" name="username" required autofocus>
                                    @if ($errors->has('username'))
                                    <span class="text-danger">{{ $errors->first('username') }}</span>
                                    @endif
                                  </div>

                                  <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email_address" class="form-control" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                  </div>

                                  <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                  </div>

                                  <div class="form-group mb-3">
                                    <input type="password" placeholder="Confirm Password" id="confirm_password" class="form-control" name="confirm_password" required>
                                    @if ($errors->has('confirm_password'))
                                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                    @endif
                                  </div>
                                  <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Create</button>
                                  </div>
                                </form>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- user create model end  -->
                <hr class="my-3">
                <div class="e-navlist e-navlist--active-bold">
                  <ul class="nav">
                    <li class="nav-item active"><a href="" class="nav-link"><span>All</span>&nbsp;<small>/&nbsp;32</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Active</span>&nbsp;<small>/&nbsp;16</small></a></li>
                    <li class="nav-item"><a href="" class="nav-link"><span>Selected</span>&nbsp;<small>/&nbsp;0</small></a></li>
                  </ul>
                </div>
                <hr class="my-3">
                <div>
                  <div class="form-group">
                    <label>Date from - to:</label>
                    <div>
                      <input id="dates-range" class="form-control flatpickr-input" placeholder="01 Dec 17 - 27 Jan 18" type="text" readonly="readonly">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Search by Name:</label>
                    <div><input class="form-control w-100" type="text" placeholder="Name" value=""></div>
                  </div>
                </div>
                <hr class="my-3">
                <div class="">
                  <label>Status:</label>
                  <div class="px-2">
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" name="user-status" id="users-status-disabled">
                      <label class="custom-control-label" for="users-status-disabled">Disabled</label>
                    </div>
                  </div>
                  <div class="px-2">
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" name="user-status" id="users-status-active">
                      <label class="custom-control-label" for="users-status-active">Active</label>
                    </div>
                  </div>
                  <div class="px-2">
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input" name="user-status" id="users-status-any" checked="">
                      <label class="custom-control-label" for="users-status-any">Any</label>
                    </div>
                  </div>
                </div>
                <hr class="my-3">
                <div class="text-center px-xl-3">
                  <button class="btn btn-primary btn-block" type="button">Search</button>
                </div>
              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
  </div>

  <style type="text/css">
    body {
      margin-top: 20px;
      background: #f8f8f8
    }
  </style>

  <script type="text/javascript">

  </script>
</body>

</html>