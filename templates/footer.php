<footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
  <div class="col-md-4 d-flex align-items-center">
    <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
      <svg class="bi" width="30" height="24">
        <use xlink:href="#bootstrap"></use>
      </svg>
    </a>
    <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Company, Inc</span>
  </div>

  <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
    <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
          <use xlink:href="#twitter"></use>
        </svg></a></li>
    <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
          <use xlink:href="#instagram"></use>
        </svg></a></li>
    <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
          <use xlink:href="#facebook"></use>
        </svg></a></li>
  </ul>
</footer>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>

<!-- JS para Datables -->
<script>
  $(document).ready(function() {
    $('#tabla_id').DataTable({
      "pageLength": 3,
      lengthMenu: [
        [3, 5, 10, 15],
        [3, 5, 10, 15],
      ],
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
      }
    });
  })
</script>
</body>

</html>