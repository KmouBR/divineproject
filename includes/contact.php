<section id="contact" class="contact">
    <div class="container">
        <h2>Entre em Contato</h2>
        <p class="section-description">Eleve sua experiência com Divine Energy</p>
        
        <div class="contact-container">
            <div class="contact-form">
                <form method="post" action="#">
                    <div class="form-group">
                        <input type="text" name="nome" placeholder="Nome" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <textarea name="mensagem" placeholder="Mensagem" rows="5" required></textarea>
                    </div>
                    <button type="submit" name="enviar" class="btn btn-primary">Enviar Mensagem</button>
                </form>
                
                <?php
                
                if (isset($_POST['enviar'])) {
                    
                    echo '<div class="success-message">Mensagem enviada com sucesso!</div>';
                }
                ?>
            </div>
            
            <div class="contact-info">
                <div class="info-item">
                    <h3>Siga-nos</h3>
                    <div class="social-links">
                        <a href="#" class="social-icon">Instagram</a>
                        <a href="#" class="social-icon">Facebook</a>
                        <a href="#" class="social-icon">Twitter</a>
                    </div>
                </div>
                
                <div class="info-item">
                    <h3>Distribuidores</h3>
                    <p>Interessado em distribuir Divine Energy?</p>
                    <a href="#" class="btn btn-secondary">Seja um Parceiro</a>
                </div>
            </div>
        </div>
    </div>
</section>
