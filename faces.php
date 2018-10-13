        <div class = "info">
            <div class = "sub-row1">
                <ol>
                    <?php if ($faces): ?>
                        <?php foreach ($faces as $key => $face): ?>
                            <li>
                                <strong>Face <?php echo $key + 1?></strong>        
                                <div class = "emotion" style = "color: #000000">
                                    <p class = "Joy">Joy:</p>
                                    <p class = "Joylikelihood"><?php echo $face->info()['joyLikelihood'] ?></p>
                                </div>
                            </li>
                        <?php endforeach ?>                        
                    <?php endif ?>
                </ol>
            </div>            
        </div>
