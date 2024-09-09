@extends('mobile/layouts.use_other_app')
@section('mobile/content')
  <div class="page-content-wrapper py-3">

    <div class="container">

  <!-- Element Heading 
      <div class="element-heading">
        <h6 class="ps-1">Recent contacts</h6>
      </div>
-->
      <!-- Chat User List -->
      <ul class="ps-0 chat-user-list">
@foreach ($users as $user)        <!-- Single Chat User -->
        <li class="p-3 chat-unread">
          <a class="d-flex" href="{{ url('/chat', $user->id ) }}">
            <!-- Thumbnail -->
            <div class="chat-user-thumbnail me-3 shadow">
              <img class="img-circle" src="{{ URL::to('/') }}/uploads/photo/{{ $user->photo }}" alt="">
              <span class="active-status"></span>
            </div>
            <!-- Info -->
            <div class="chat-user-info">
              <h6 class="text-truncate mb-0">{{ $user->name }}</h6>
              <div class="last-chat">
                <p class="mb-0 text-truncate">{{ $user->phone }}
                <!--    <span class="badge rounded-pill bg-primary">2</span> -->
                </p>
              </div>
            </div>
          </a>

          <!-- Options -->
          <!-- <div class="dropstart chat-options-btn">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#"><i class="bi bi-mic-mute"></i>Mute</a></li>
              <li><a href="#"><i class="bi bi-slash-circle"></i>Ban</a></li>
              <li><a href="#"><i class="bi bi-trash"></i>Remove</a></li>
            </ul>
          </div> -->
        </li>
@endforeach
		</ul>
@endsection
