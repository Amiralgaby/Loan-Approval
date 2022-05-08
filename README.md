# Loan-Approval

## Stucture

Un dossier par projet API
 - Dossier **AccountManager** : services AccountManager et CheckAccountRisk
 - Dossier **AppManager** ou **ApprovalManager** : service ApprovalManager et LoanApproval

Un dossier par projet Client
 - Curl/bash si Linux
 - Guzzle pour tester le service composite en prévoyant la plupart des cas

### LoanApproval

| Verbe | Route API | Localisation dans le projet |
| --- | --- | :---: |
| GET | test?accountNum={bank_account_id}&valeur={account} | *à compléter* |

### AccountManager

endpoint du service : https://resolute-planet-344619.oa.r.appspot.com/

| Verbe | Route API | Data | Localisation dans le projet |
| --- | --- | --- | --- |
| GET | acc/ | - | GetMapping in [AccountManager.java](account-manager/src/main/java/gabriel/AccountManager/controllers/AccManager.java) |
| GET | acc/{bank_account_id} | - | GetMapping("{id}") in [AccountManager.java](/account-manager/src/main/java/gabriel/AccountManager/controllers/AccManager.java) |
| POST | acc/ | format JSON de BankAccount.java | PostMapping("{id}") in [AccountManager.java](account-manager/src/main/java/gabriel/AccountManager/controllers/AccManager.java#L35) |
| PUT | acc/{bank_account_id} | format JSON de BankAccount.java | PutMapping("{id}") in [AccountManager.java](account-manager/src/main/java/gabriel/AccountManager/controllers/AccManager.java) |
| DELETE | acc/{bank_account_id} | - | DeleteMapping("{id}") in [AccountManager.java](account-manager/src/main/java/gabriel/AccountManager/controllers/AccManager.java)

format JSON pour BankAccount : `{"nom":"string","prenom":"string","account":int,"risk":[0-1]}`

#### CheckAccountRisk

| Verbe | Route API | Localisation dans le projet |
| --- | --- | :---: |
| GET | check/{bank_account_id} | [CheckAccountRisk.java](account-manager/src/main/java/gabriel/AccountManager/controllers/CheckAccountRisk.java) |

### ApprovalManager

| Verbe | Route API | Data JSON | Localisation dans le projet |
| --- | --- | --- | :---: |

## Les services
 - **AccManager** : comptes bancaires 
	 - Ajouter
	 - Supprimer
	 - Lister
  - **AppManager** : approval
	 - Ajouter
	 - Supprimer
	 - Lister
- **Check_account** : vérifier le risque pour un compte 
	 - retourne un risque (*"high"* ou  *"low"*) suivant un compte
- **LoanApproval** : reçoit des demandes de crédits (nom, somme  au moins)
	 - Si la `somme < 10k` 
		 - Appel de ***CheckAccountRisk*** pour connaitre le risque
			 - Si le `risque == "high"`
				 - Appel de ***AppManager***
			 - Sinon
				 - La réponse est *"approved"* et la somme totale du compte est donnée 
	 -  Si la `somme >= 10k`
		 - Appel de ***AppManager***

	 - Si ***AppManager*** est appelé pour connaitre la réponse
		 - La réponse est retournée à l'utilisateur avec son compte
			 - Si la `réponse == "accepeted"`
				 - Le compte est crédité et le message *"approved"* est renvoyé

## Notes

Voir mail du 26 janvier par M. Salva pour le PDF

À remettre pour samedi 28 mai 12h au plus tard, sur moodle 

 https://ent.uca.fr/moodle/course/view.php?id=22844


## Ressources

 - [Gcloud start project (uniquement accès pour Gabriel je crois)](https://console.cloud.google.com/appengine/start?project=resolute-planet-344619)
 - [Racine de mon API sur Gcloud](https://resolute-planet-344619.oa.r.appspot.com/)
 - [Route (/acc) pour obtenir les accounts dans mon API sur Gcloud](https://resolute-planet-344619.oa.r.appspot.com/acc)
