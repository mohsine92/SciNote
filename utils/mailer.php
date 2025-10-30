<?php

class Email {
    
    public static function send($to, $subject, $message, $headers = []) {
        // En-têtes par défaut
        $defaultHeaders = [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=UTF-8',
            'From: noreply@scientific-articles.com',
        ];
        
        $allHeaders = array_merge($defaultHeaders, $headers);
        $headersString = implode("\r\n", $allHeaders);
        
        return mail($to, $subject, $message, $headersString);
    }

    public static function sendArticleConfirmation($article) {
        $to = $article['email_auteur'];
        $subject = "Confirmation de publication - " . $article['titre'];
        
        $message = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #007bff; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; background-color: #f9f9f9; }
                .button { display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; }
                .info { background-color: white; padding: 15px; margin: 10px 0; border-left: 4px solid #007bff; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Article Scientifique Publié</h1>
                </div>
                <div class='content'>
                    <p>Bonjour <strong>" . htmlspecialchars($article['nom_auteur']) . "</strong>,</p>
                    <p>Votre article a été enregistré avec succès dans notre base de données.</p>
                    
                    <div class='info'>
                        <h3>Détails de l'article :</h3>
                        <p><strong>Titre :</strong> " . htmlspecialchars($article['titre']) . "</p>
                        <p><strong>Date de publication :</strong> " . htmlspecialchars($article['date_publication']) . "</p>
                        <p><strong>Nombre de citations :</strong> " . htmlspecialchars($article['nombre_citations']) . "</p>
                        <p><strong>Résumé :</strong></p>
                        <p>" . nl2br(htmlspecialchars($article['resume'])) . "</p>
                    </div>
                    
                    <p>Pour consulter les détails complets de votre article, cliquez sur le lien ci-dessous :</p>
                    <a href='http://localhost/scientific-articles/public/admin/articles/" . $article['id'] . "' class='button'>Voir l'article</a>
                    
                    <p style='margin-top: 30px; font-size: 12px; color: #666;'>
                        Cet email a été envoyé automatiquement, merci de ne pas y répondre.
                    </p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        return self::send($to, $subject, $message);
    }
}