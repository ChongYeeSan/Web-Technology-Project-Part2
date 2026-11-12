<?php
$page_title = "Ecopower - Home";
include("inc/header.inc");
?>

    <section class="hero-banner">
      <h2><em>"Powering a Cleaner Tomorrow through smart technology"</em></h2>
      <p>Description: Ecopower is such a great company to provide smart renewable energy solutions dedicated to powering a sustainable and greener future through innovative technology.</p>
      <div class="hero-btn-grp" >
     <a href="about.php" class="hero-btn">Explore Projects</a>
      <a href="jobs.php" class="hero-btn">Join our Team</a>
    </div>
    </section>

<div class="search-table-row">

     <table class="data-table">
<thead>
  <tr>
    <th>Featured Project</th>
    <th>Location</th>
    <th>Status</th>

    
  </tr>
  
</thead>
<tbody>
  <tr>
    <td rowspan="3"  >Renewable Energy Hub</td>
     <td>Sunway</td>
      <td>Completed</td>
      
  </tr>
  <tr>
 
    <td>Pj</td>
     <td>In Progress</td>
     
    </tr>
  <tr>
    
    <td>Klang</td>
    <td>Planned</td>
    
  </tr>
</tbody>
  </table> 
 
  <section class="search-section">
  
  <h3>Search projects and roles ! :</h3>
    <form action="search.php" method ="get" class="search-box">
    <label for="search-input" class="visually-hidden">Search projects and roles</label>
    <input type="text" id="search-input" name="query" placeholder="Search" >
        <button type="submit" class="hero-btn">Search</button>

   </form>
 </section>
</div>

 <div class="ack-box">
  <strong>Acknowledgment:</strong>
  Ecopower respectfully acknowledges the Aboriginal and Torres Strait Islander peoples as the Traditional Custodians of the land, and pays respect to Elders past and present.
 </div>

<?php include("inc/footer.inc"); ?>