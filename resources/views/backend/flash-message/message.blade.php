
@if ($message = Session::get('success'))
<div class="toast_main" style="width:200px;height:70px">
    <div class="toast custom_toast bg-success" style="position: absolute; top: 20px; right: 50px; z-index:9999" data-delay="10000">
        <div class="toast-header">
          {{-- <img src="..." class="rounded mr-2" alt="..."> --}}
          <strong class="mr-auto">Stowaa</strong>
            @php
                $time = date('s')
            @endphp
          <small id="test">{{ $time-$time+1 . " s ago"}}</small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          {{ $message }}
        </div>
    </div>
</div>
@endif 
{{-- 
<script>
      // Called the function in each second
      var number = document.querySelector('#test').text();
      window.alert(number);
      var interval = setInterval(function() {
        document.querySelector('#test').text(number++); // Update the value in paragraph

        if (number > 10) {
            clearInterval(interval); // If exceeded 100, clear interval
        }
    }, 1000); // Run for each second
</script> --}}