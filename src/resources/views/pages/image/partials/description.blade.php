<div class="card">
    <div class="card-content">
        <span class="card-title">
            <span>{{ $image->name }}</span>
        </span>
        <p>
            {!! nl2br(e($image->description)) !!}
        </p>
    </div>
</div>