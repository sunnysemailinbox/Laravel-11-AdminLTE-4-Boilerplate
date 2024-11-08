<!-- Modal -->
<div {{ $attributes->merge(['class' => 'modal fade']) }}>
  <div class="modal-dialog">
    <div class="modal-content">
        {{ $slot }}
    </div>
  </div>
</div>
