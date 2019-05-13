@push('scripts')
<script>
function getLocation(func) {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(func);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}
</script>
@endpush