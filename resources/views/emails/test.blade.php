<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Info Mail</title>
</head>
<body>
    <p>Bonjour {{ $user->name ?? 'Utilisateur' }},</p>

    @if(! empty($univers))
        <p>Nous souhaitons vous tenir au courant que l'univers "{{ $univers->name }}" a été créé ou modifié par un administrateur.</p>
        <p>Pour y accéder, cliquez sur le lien suivant : <a href="{{ url('/') }}">{{ url('/') }}</a><br>La team des univers</p>
    @else
        <p>Nous souhaitons vous tenir au courant d'une modification d'un univers. Aucune information détaillée n'est disponible.</p>
        <p>Pour y accéder, cliquez sur le lien suivant : <a href="{{ url('/') }}">Page d'accueil des univers</a><br>La team des univers</p>

    @endif
</body>
</html>
