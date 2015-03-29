        </div><!-- ./wrapper -->
    </body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60692087-1', 'auto');
  ga('send', 'pageview');

  //firing event to track user
  ga('send', 'event', 'user', 'authenticated user accessed page', $('#loggedInEmailUser').text());


  function printCurrentPage () {
    window.print();
  }

</script>


<!-- AdminLTE App -->
<script src="../../../assets/js/AdminLTE/app.js" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="../../../assets/js/AdminLTE/demo.js" type="text/javascript"></script>
<script src="../../../assets/js/AdminLTE/dashboard.js" type="text/javascript"></script>

<!-- DATA TABES SCRIPT -->
<script src="../../../assets/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="../../../assets/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

</html>