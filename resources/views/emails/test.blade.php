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
    <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.sciencesetavenir.fr%2Fespace%2Funivers%2Fquestion-de-la-semaine-quelle-est-la-plus-grande-distance-observable-dans-l-univers_139583&psig=AOvVaw0BiPLob4CvdbS2L87jvGyC&ust=1761751855190000&source=images&cd=vfe&opi=89978449&ved=0CBUQjRxqFwoTCKjD5Z6bx5ADFQAAAAAdAAAAABAL" alt="Notre monde">
</body>
</html>
