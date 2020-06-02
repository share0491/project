<style type="text/css">
html,
body {
  height: 100%;
  /* The html and body elements cannot have any padding or margin. */
}

/* Wrapper for page content to push down footer */
#wrap {
  min-height: 100%;
  height: auto;
  /* Negative indent footer by its height */
  margin: 0 auto -60px;
  /* Pad bottom by footer height */
  padding: 0 0 60px;
}

/* Set the fixed height of the footer here */
#footer {
  height: 60px;
  background-color: #f5f5f5;
  margin-top: 50px;
}


/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */


.container .credit {
  margin: 20px 0;
}

@media print {
	#footer { display: none !important; }
}

</style>
<a name="bottom_page"></a>
<div id="footer">
      <div class="container">
        <p class="text-muted credit">&copy;  <?php $t_year = date(Y); echo $t_year; ?> myavita.com | Error Report to <a href="mailto:share@avitaglobal.com" style="text-decoration:none;"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></p>
      </div>
</div>