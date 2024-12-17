<div class="favorite-list-item">
    @if ($user)
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            style="background-image: url('{{ Chatify::getUserWithAvatar($user)->avatar }}');">
        </div>
        <p>{{ strlen($user->first_name) > 5 ? substr($user->first_name, 0, 6) . '..' : $user->first_name }}</p>
    @endif
</div>
