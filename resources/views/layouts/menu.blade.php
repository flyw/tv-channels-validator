<li class="nav-item">
    <a class="nav-link {{ active_class(Active::checkUriPattern('playlists*')) }}" href="{{ route('playlists.index') }}">
        <i class="nav-icon fas fa-info-circle"></i>Playlists
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ active_class(Active::checkUriPattern('channels*')) }}" href="{{ route('channels.index') }}">
        <i class="nav-icon fas fa-info-circle"></i>Channels
    </a>
</li>

