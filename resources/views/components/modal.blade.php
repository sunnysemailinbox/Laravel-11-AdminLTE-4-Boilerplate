<!-- Modal -->
<div {{ $attributes->merge(['class' => 'modal fade']) }} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        {{ $slot }}
    </div>
  </div>
</div>
