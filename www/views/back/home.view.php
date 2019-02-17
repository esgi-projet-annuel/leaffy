<div class="container-back">

    <?php $this->addMenu("back", "back");?><!--    include menu-->

  <div id="content-back" class="">
    <div class="">
      <div class="titre">
        <h2>Informations personnelles</h2>
      </div>
    </div>
    <form class="" action="index.html" method="post">
      <div class="section">
          <div class="container">
              <div class="row">
                <div class="col-6 fields-input-back">
                  <label> Votre Nom<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                  <label> Votre Prénom<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                  <label> Votre Numéro<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                  <label> Votre Email<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                  <label> Votre Adresse<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                  <label> Votre Profession<br />
                      <span class="form-control your-subject">
                        <input type="text" name="your-subject" value="" size="40" class="form-control form-text" aria-invalid="false" />
                      </span>
                  </label>
                </div>
                <div class="col-sm-4 col-12 d-flex">
                  <div id="avatar-back" class="margin-auto d-flex">
                      <img class="margin-auto" src="../../public/img/avatar.jpg" alt="">
                      <div class="form-control your-name">
                        <input type="file" name="your-file" value="" size="40" class="form-control form-file" aria-required="true" aria-invalid="false" />
                      </div>
                  </div>
                </div>
                <div class="col-sm-8 col-12">
                  <div>À propos de vous</div>
                  <div class="section-description section-description--about">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dictum odio eget nisi hendrerit, nec imperdiet mi consectetur. Curabitur in sem ut ex pulvinar laoreet. Phasellus ac luctus nisl. In id velit sit amet enim hendrerit luctus ut eget mi. Phasellus eget ullamcorper sapien. Nullam mi diam, aliquam et quam dignissim, congue sollicitudin ex. Fusce iaculis</p>
                      </br>
                  </div>
                </div>
              </div>
              <div>
                  <input type="submit" value="Enregistrer" class="form-control submit-button" />
              </div>
          </div>
      </div>
    </form>
  </div>
</div> // END div container-back
