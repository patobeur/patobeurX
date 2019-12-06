            <!-- - - - - - - - - - - - - - - - - - - - - -->
            <!-- EXERCICES -->
            <section id="coding" class="exercices">
                <h2>Exercices HTML</h2>
                <div class="container">
                    <article class="fiche javascript" href="#">
                        <div class="annonces">
                            <h3>Exercices HTML</h3>
                            <p>source : <a href="https://campus.cefim.eu/course/view.php?id=281">Cefim</a></p>
                        </div>
                    </article>
                    <article class="fiche snowmount" href="#">
                        <div class="annonces">
                            <h3>HTML5 et CSS3 SnowMount</h3>
                            <a href="adds/htmlcss/snowmount/index.html" target="out">SnowMount</a>
                            <p>Exercice d'intégration d'une structure de page responsive avec GRID et FLEX</p>
                        </div>
                    </article>
                    <article class="fiche elka" href="#">
                        <div class="annonces">
                            <h3>GRID Elka</h3>
                            <a href="adds/form-js-ajax-php/index.html" target="out">Formulaire Elka</a>
                            <p>Exercice d'intégration d'un formulaire en Responsiv Design</p>
                        </div>
                    </article>
                    <article class="fiche encours" href="#">
                        <div class="annonces">
                            <h3>Pendant le cours</h3>
                            <p>Vraiment à l'arrache !</p>
                            <a href="adds/javascript/exercice_javascript.html">Algorytme JS</a>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche triangle" href="#">
                        <div class="annonces">
                            <h3>Des triangles</h3>
                            <p>Dessiner différents types de triangles.
                            Pour l'affichage, vous pourrez utiliser console.log</p>
                            <a href="https://campus.cefim.eu/mod/assign/view.php?id=8941" target="exercices_4" class="source">Source Cefim Campus</a>
                            <button onclick="triangles()" class="starter">Calculer</button>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche boisson" href="#">
                        <div class="annonces">
                            <h3>Boucle</h3>
                            <p>Comme une boisson dans l'eau !</p>
                            <a href="https://campus.cefim.eu/mod/assign/view.php?id=8936" target="exercices_4" class="source">Source Cefim Campus</a>
                            <button onclick="BoireOuCoder()" class="starter">Calculer</button>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche euros" href="#">
                        <div class="annonces">
                            <h3>Un convertisseur d'Euro</h3>
                            <label class="label1" for="champs1">Euros</label>
                            <input id="champsE" type="text" class="input_1" placeholder="">
                            <select name="monnaies" id="Monnaies">
                                <option selected value="DOL">Dollars Américain</option>
                                <option value="CAD">Dollar Canadien</option>
                                <option value="AUD">Dollar Australien</option>
                                <option value="BGP">Livre Sterling</option>
                                <option value="JPY">Yen Japonais</option>
                                <option value="CNY">Yuan Chinois</option>
                                <option value="CHF">Franc Suisse</option>
                            </select>
                            <input id="champsD" type="text" class="input_2" placeholder="" readonly="readonly">
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche dollar" href="#">
                        <div class="annonces">
                            <h3>Un convertisseur euro/dollars</h3>
                            <p>(version prompt et alert)</p>
                            <button onclick="prompt_dollars2euros()" class="starter">Euros to Dollars</button>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche perimetre" href="#">
                        <div class="annonces">
                            <h3>Périmètre Version DOM</h3>
                            <input type="text" id="Plargeur">
                            <select name="unitelargueur" id="PunitLarg">
                                <option value="mm">mm</option>
                                <option value="cm">cm</option>
                                <option value="dm">dm</option>
                                <option selected value="m">m</option>
                                <option value="km">dam</option>
                                <option value="km">hm</option>
                                <option value="km">km</option>
                                </select>
                            <input type="text" id="Plongueur">
                            <select name="unitelongueur" id="PUnitLong">
                                <option value="mm">mm</option>
                                <option value="cm">cm</option>
                                <option value="dm">dm</option>
                                <option selected value="m">m</option>
                                <option value="km">dam</option>
                                <option value="km">hm</option>
                                <option value="km">km</option>
                            </select>
                            <p id="LAPerimdom"></p>
                            <p id="mesresultats"></p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche perimetre" href="#">
                        <div class="annonces">
                            <h3>Un calculateur de périmètre</h3>
                            <p>en m, dm, cm ou mm (ex : 17 mm)</p>
                            <button onclick="perimetre()" class="starter">Calculer</button>
                            <p>Calculer un périmètre.</p>
                            <p id="dernierperimetre"></p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche kelvin" href="#">
                        <div class="annonces">
                            <h3>Kelvin, Farenheit, celsius</h3>
                            <p>Calculer des températures.<br/>[C = (F-32)/1,8000] 
                                [F = (C * 1,8) + 32]<br/>[K = ((F - 32) /1,8) + 273.15] 
                                [C = K - 273.15]</p>
                            <button onclick="temperature()" class="starter">Calculer</button>
                            <p id="dernieretemerature"></p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche serial" href="#">
                        <div class="annonces">
                            <h3>Invalid Serial Number !</h3>
                            <p>Renseignez un numéro de serie !</p>
                            <button onclick="serialcheck()" class="starter">Check Serial</button>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>A FAIRE</h3>
                            <p>Les bases algorithmiques</p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>Fonction - Factorielle</h3>
                            <p>source : <a href="https://campus.cefim.eu/mod/assign/view.php?id=8940">Cefim</a></p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>Tableau - Au score !</h3>
                            <p>source : <a href="https://campus.cefim.eu/mod/assign/view.php?id=8942">Cefim</a></p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>Tableau - Une nouvelle dimension</h3>
                            <p>source : <a href="https://campus.cefim.eu/mod/assign/view.php?id=8943">Cefim</a></p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>Objets littéraux - Mon équipe de dev</h3>
                            <p>source : <a href="https://campus.cefim.eu/mod/assign/view.php?id=8944">Cefim</a></p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>Exercices d'entrainement</h3>
                            <p>source : <a href="https://campus.cefim.eu/mod/page/view.php?id=9302">Cefim</a></p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>Fonction - Factorielle</h3>
                            <p>source : <a href="https://campus.cefim.eu/mod/assign/view.php?id=8940">Cefim</a></p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>A FAIRE</h3>
                            <p>La manipulation du DOM</p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>Modification - Retour en arrière</h3>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>Ajout - Bloc Note (Part. 1)</h3>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>Suppression - Bloc Note (Part. 2)</h3>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>Atelier</h3>
                            <p>Insertion, Drag & Drop - Bloc Note (Part. 3)</p>
                        </div>
                    </article>
                    <!-- - - - - - - - - - - - - - - - - - - -  -->
                    <article class="fiche afaire" href="#">
                        <div class="annonces">
                            <h3>Projet fil-rouge</h3>
                            <p>Ajout dynamique d'éléments dans le DOM</p>
                        </div>
                    </article>
                </div>
            </section>
            <!-- - - - - - - - - - - - - - - - - - - -  -->
            <script src="adds/javascript/js/constantes.js" type="text/javascript"></script>
            <script src="adds/javascript/js/moneychange.js" type="text/javascript"></script>
            <script src="adds/javascript/js/perimetre.js" type="text/javascript"></script>
            <script src="adds/javascript/js/temperature.js" type="text/javascript"></script>
            <script src="adds/javascript/js/serialcheck.js" type="text/javascript"></script>
            <script src="adds/javascript/js/boireoucoder.js" type="text/javascript"></script>
            <script src="adds/javascript/js/triangles.js" type="text/javascript"></script>
            <!-- END's EXERCICES -->
            <!-- - - - - - - - - - - - - - - - - - - - - -->