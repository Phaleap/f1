<div id="music-card">
    <div id="music-card-inner">
        <img id="hans-img" src="{{ asset('image/hans-zimmer.png') }}" alt="Hans Zimmer">
        <div id="music-info">
            <span id="music-label">Now Playing</span>
            <span id="music-name">Hans Zimmer</span>
            <span id="music-track">Two Steps From Hell</span>
        </div>
    </div>
    <button id="mute-btn" onclick="toggleMute()" title="Toggle Audio">
        <svg id="icon-unmute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
            <path d="M19.07 4.93a10 10 0 0 1 0 14.14"/>
            <path d="M15.54 8.46a5 5 0 0 1 0 7.07"/>
        </svg>
        <svg id="icon-mute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none">
            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
            <line x1="23" y1="9" x2="17" y2="15"/>
            <line x1="17" y1="9" x2="23" y2="15"/>
        </svg>
    </button>
</div>