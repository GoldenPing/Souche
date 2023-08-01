<form action="/research" method="GET">

    <div id="form">
        <input type="hidden" name="isMyList" value="true">
        <input name="search" id="search" type="text" placeholder="Recherche ton Anime"
               value="<?php if (isset($data['input']['search']) && $data['input']['search'] !== '') echo $data['input']['search']; ?>">

        <select name="tags" id="tagsSelect">
            <option value="." selected>Tags</option>
            <?php foreach ($data['tags'] as $key => $value) : ?>
                <option <?php if (isset($data['input']['tags']) && $data['input']['tags'] === $value->idTags) echo "selected"; ?>
                        value="<?php echo $value->idTags; ?>"><?php echo $value->nameTags ?></option>
            <?php endforeach; ?>
        </select>

        <select name="studio" id="studioSelect">
            <option value="." selected>Studio</option>
            <?php foreach ($data['studio'] as $key => $value) : ?>
                <option <?php if (isset($data['input']['studio']) && $data['input']['studio'] === $value->idStudio) echo "selected"; ?>
                        value="<?php echo $value->idStudio; ?>"><?php echo $value->nameStudio ?></option>
            <?php endforeach; ?>
        </select>

        <button id="search-button"><i class="fas fa-search"></i></button>


    </div>

</form>

<section>

        <form action="/filter" method="get">
            <div id="fromTri">
                <input type="hidden" name="idUser" value="<?php echo $_GET['id']?? $_GET['idUser'] ?>">

                <select name="etat" id="etatSelect">
                <option value="." selected>Etat</option>
                <?php foreach ($data['etats'] as $key => $value) : ?>
                    <option <?php if (isset($data['input']['etat']) && $data['input']['etat'] === $value->idEtat) echo "selected"; ?>
                            value="<?php echo $value->idEtat; ?>"><?php echo $value->libelleEtat ?></option>
                <?php endforeach; ?>
            </select>

            <select name="note" id="noteSelect">
                <option value="." selected>Note</option>
                <?php foreach ($data['notes'] as $key => $value) : ?>
                    <option <?php if (isset($data['input']['note']) && $data['input']['note'] === $value->idNote) echo "selected"; ?>
                            value="<?php echo $value->idNote; ?>"><?php echo $value->libelleNote ?></option>
                <?php endforeach; ?>
            </select>

            <button id="search-button"><i class="fa-solid fa-filter"></i></button>
            </div>

        </form>
    <div id="listAnime">
        <?php if (isset($data['anime']) && !empty($data['anime'])) :
            foreach ($data['anime'] as $key => $value) : ?>

                <div class="anime">
                    <a href="\anime?id=<?php echo $value->idAnime ?>"> <img src="img/<?php echo $value->pathAnime; ?>"
                                                                            alt="<?php echo $value->nameAnime; ?> affiche">
                    </a>
                </div>


            <?php endforeach; ?>
        <?php else: ?>
            <div class="notFound"><p>Désoler mais on a trouvé aucun anime dans ta liste... Est tu sûr d'envoir ajouter
                    ??</p></div>
        <?php endif; ?>
    </div>
</section>


