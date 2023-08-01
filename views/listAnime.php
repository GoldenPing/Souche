<form action="/research" method="GET">

    <div id="form">

        <input name="search" id="search" type="text" placeholder="Recherche ton Anime" value="<?php if (isset($data['input']['search']) && $data['input']['search'] !== '')  echo $data['input']['search']; ?>">

        <select name="tags" id="tagsSelect">
            <option value="." selected>Tags</option>
            <?php foreach ($data['tags'] as $key => $value) : ?>
                <option <?php if (isset($data['input']['tags']) && $data['input']['tags'] === $value->idTags) echo "selected"; ?> value="<?php echo $value->idTags; ?>"><?php echo $value->nameTags ?></option>
            <?php endforeach; ?>
        </select>

        <select name="studio" id="studioSelect">
            <option value="." selected>Studio</option>
            <?php foreach ($data['studio'] as $key => $value) : ?>
                <option <?php if (isset($data['input']['studio']) && $data['input']['studio'] === $value->idStudio) echo "selected"; ?> value="<?php echo $value->idStudio; ?>"><?php echo $value->nameStudio ?></option>
            <?php endforeach; ?>
        </select>

        <button id="search-button"><i class="fas fa-search"></i></button>


    </div>

</form>

<section>
    <div id="listAnime">
        <?php if (!is_null($data['anime'])) :
            foreach ($data['anime'] as $key => $value) : ?>

                <div class="anime">
                    <a href="\anime?id=<?php echo $value->idAnime ?>"> <img src="img/<?php echo $value->pathAnime; ?>" alt="<?php echo $value->nameAnime; ?> affiche"> </a>
                </div>


            <?php endforeach; ?>
            <?php else: ?>
            <div class="notFound"><p>Aucun anime trouvé veuillez vérifier les champs saisies</p></div>
        <?php endif; ?>
    </div>
</section>