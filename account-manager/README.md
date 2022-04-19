# Notes
## gcloud
### Installation

[Gcloud installation documentation](https://cloud.google.com/sdk/docs/install) (en)

>To initialize the gcloud CLI, run gcloud init:
>./google-cloud-sdk/bin/gcloud init

### Mise à jour

```sh
gcloud components update # à éviter si vous êtes passé par snap ou un gestionnaire intégré à votre distribution
```

### Auth

```sh
gcloud auth login
```

### Sélection du projet sur lequel travailler

```sh
gcloud config set project [project-id]
```

### Logs

```sh
gcloud app logs tail -s default
```

## mvn
### Clean package
mvn clean package

### run spring-boot
mvn spring-boot:run

### Déploiement

```sh
mvn -DskipTests package appengine:deploy
```

L'option -DskipTests permet de ne pas lancer les tests (très pratique notamment si vous utilisez des Lib/Bd du cloud). 


Après avoir lancé le déploiement l'url cible est affichée dans la console.

Pour moi ce fut :
`[INFO] GCLOUD: Deployed service [default] to [https://resolute-planet-344619.oa.r.appspot.com]`


