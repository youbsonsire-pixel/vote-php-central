# Projet 17 — Plateforme de vote en ligne
## Instructions complètes — 4 personnes

---

## VUE D'ENSEMBLE

```
MAINTENEUR
├── Crée le dépôt GitHub vote-php-central
├── Pousse le Sondage.php de base
├── Invite les 3 contributeurs
├── Examine chaque Pull Request
└── Fusionne les 3 PR dans l'ordre

CONTRIBUTEUR A → ajoute afficherResultats()
CONTRIBUTEUR B → ajoute cloturerSondage() + estCloture()
CONTRIBUTEUR C → ajoute exporterCSV() + exporterJSON()
```

**Ordre à respecter :**
```
Mainteneur pousse main
      ↓
Contributeur A pousse feature/resultats → Mainteneur fusionne PR #1
      ↓
Contributeur B pousse feature/cloture  → Mainteneur fusionne PR #2
      ↓
Contributeur C pousse feature/export   → Mainteneur fusionne PR #3
```

---

---

# 🔧 MAINTENEUR

---

## PHASE 1 — Créer le dépôt sur GitHub (navigateur)

1. Aller sur **https://github.com** et se connecter
2. Cliquer sur **"New repository"** (bouton vert)
3. Remplir :
   - **Repository name** : `vote-php-central`
   - **Visibility** : Private ou Public
   - ⚠️ **Ne pas cocher** "Add a README file" — laisser tout vide
4. Cliquer **"Create repository"**

---

## PHASE 2 — Préparer le dossier local sur son PC

Ouvrir un terminal (PowerShell sur Windows) :

```bash
# Créer le dossier de travail
mkdir vote-php-central
cd vote-php-central

# Initialiser Git
git init
git config user.name "Votre Nom"
git config user.email "votre@email.com"
```

Copier le fichier **`Sondage.php`** (du ZIP Mainteneur) dans ce dossier.

Vérifier qu'il est bien là :
```bash
dir
# Doit afficher : Sondage.php
```

Faire le premier commit :
```bash
git add Sondage.php
git commit -m "feat: initialisation du projet — classe Sondage avec ajouterOption() et voter()"
```

---

## PHASE 3 — Envoyer le code sur GitHub

```bash
git branch -M main
git remote add origin https://github.com/<votre-pseudo>/vote-php-central.git
git push -u origin main
```

Vérifier sur **https://github.com/\<votre-pseudo\>/vote-php-central** que `Sondage.php` est visible. ✅

---

## PHASE 4 — Inviter les 3 contributeurs

Sur GitHub, dans le dépôt `vote-php-central` :

1. Cliquer sur **Settings**
2. Dans le menu gauche : **Collaborators**
3. Cliquer **"Add people"**
4. Entrer le pseudo GitHub de chaque contributeur
5. Leur envoyer l'URL du dépôt :
   ```
   https://github.com/<votre-pseudo>/vote-php-central.git
   ```

---

## PHASE 5 — Fusionner les Pull Requests

⚠️ Fusionner dans l'ordre : PR #1 d'abord, puis #2, puis #3.

### Option A — Via GitHub (plus simple)

1. Aller sur **https://github.com/\<votre-pseudo\>/vote-php-central**
2. Cliquer sur l'onglet **"Pull requests"**
3. Ouvrir la PR du contributeur
4. Cliquer sur l'onglet **"Files changed"** pour examiner le code
5. Revenir sur **"Conversation"** puis cliquer **"Merge pull request"**
6. Cliquer **"Confirm merge"** ✅

### Option B — Via terminal

```bash
cd vote-php-central

# ── PR #1 — Contributeur A ──────────────────────────────────
git fetch origin
git log origin/feature/resultats --oneline
git diff origin/main..origin/feature/resultats
git checkout main
git merge origin/feature/resultats --no-ff -m "Merge PR #1 : feature/resultats → main [Contributeur A]"
git push origin main

# ── PR #2 — Contributeur B ──────────────────────────────────
git fetch origin
git log origin/feature/cloture --oneline
git diff origin/main..origin/feature/cloture
git checkout main
git merge origin/feature/cloture --no-ff -m "Merge PR #2 : feature/cloture → main [Contributeur B]"
git push origin main

# ── PR #3 — Contributeur C ──────────────────────────────────
git fetch origin
git log origin/feature/export --oneline
git diff origin/main..origin/feature/export
git checkout main
git merge origin/feature/export --no-ff -m "Merge PR #3 : feature/export → main [Contributeur C]"
git push origin main
```

---

## PHASE 6 — Vérification finale

```bash
git log --oneline --graph
```

Résultat attendu :
```
*   Merge PR #3 : feature/export → main [Contributeur C]
|\
| * feat(export): exporterCSV() et exporterJSON()
|/
*   Merge PR #2 : feature/cloture → main [Contributeur B]
|\
| * feat(cloture): cloturerSondage() + estCloture()
|/
*   Merge PR #1 : feature/resultats → main [Contributeur A]
|\
| * feat(resultats): afficherResultats() avec barres et pourcentages
|/
* feat: initialisation du projet — classe Sondage avec ajouterOption() et voter()
```

---

---

# 👤 CONTRIBUTEUR A

**Mission :** ajouter la méthode `afficherResultats()` dans `Sondage.php`

---

## ÉTAPE 1 — Cloner le dépôt GitHub

Attendre que le mainteneur vous envoie l'invitation GitHub et l'URL du dépôt.

```bash
git clone https://github.com/<pseudo-mainteneur>/vote-php-central.git
cd vote-php-central

git config user.name "Votre Nom"
git config user.email "votre@email.com"
```

---

## ÉTAPE 2 — Créer votre branche

```bash
git checkout -b feature/resultats
```

---

## ÉTAPE 3 — Ajouter votre code

Copier le fichier **`Sondage.php`** (du ZIP Contributeur-A) dans le dossier `vote-php-central`.

Vérifier :
```bash
dir
# Doit afficher : Sondage.php
```

---

## ÉTAPE 4 — Envoyer votre branche

```bash
git add Sondage.php
git commit -m "feat(resultats): afficherResultats() avec barres et pourcentages"
git push -u origin feature/resultats
```

---

## ÉTAPE 5 — Ouvrir la Pull Request sur GitHub

1. Aller sur **https://github.com/\<pseudo-mainteneur\>/vote-php-central**
2. GitHub affiche une bannière jaune :
   ```
   Your recently pushed branches: feature/resultats
   [ Compare & pull request ]
   ```
3. Cliquer **"Compare & pull request"**
4. Remplir le formulaire :
   - **Titre** : `feat(resultats): afficherResultats() avec barres et pourcentages`
   - **Description** : `Ajout de afficherResultats() qui affiche les résultats avec barres visuelles et pourcentages`
   - Vérifier que la flèche indique : `feature/resultats → main`
5. Cliquer **"Create pull request"** ✅
6. Envoyer le lien de la PR au mainteneur

---

---

# 👤 CONTRIBUTEUR B

**Mission :** ajouter `cloturerSondage()` et `estCloture()` dans `Sondage.php`

⚠️ **Attendre que la PR du Contributeur A soit fusionnée avant de commencer.**

---

## ÉTAPE 1 — Cloner le dépôt GitHub

```bash
git clone https://github.com/<pseudo-mainteneur>/vote-php-central.git
cd vote-php-central

git config user.name "Votre Nom"
git config user.email "votre@email.com"
```

---

## ÉTAPE 2 — Synchroniser avec le main à jour

```bash
git fetch origin
git merge origin/main
```

---

## ÉTAPE 3 — Créer votre branche

```bash
git checkout -b feature/cloture
```

---

## ÉTAPE 4 — Ajouter votre code

Copier le fichier **`Sondage.php`** (du ZIP Contributeur-B) dans le dossier `vote-php-central`.

Vérifier :
```bash
dir
# Doit afficher : Sondage.php
```

---

## ÉTAPE 5 — Envoyer votre branche

```bash
git add Sondage.php
git commit -m "feat(cloture): cloturerSondage() + estCloture() — verrouillage définitif"
git push -u origin feature/cloture
```

---

## ÉTAPE 6 — Ouvrir la Pull Request sur GitHub

1. Aller sur **https://github.com/\<pseudo-mainteneur\>/vote-php-central**
2. Cliquer sur le bouton jaune **"Compare & pull request"**
3. Remplir le formulaire :
   - **Titre** : `feat(cloture): cloturerSondage() + estCloture()`
   - **Description** : `Ajout de cloturerSondage() qui verrouille définitivement le sondage et estCloture() pour tester l'état`
   - Vérifier : `feature/cloture → main`
4. Cliquer **"Create pull request"** ✅
5. Envoyer le lien de la PR au mainteneur

---

---

# 👤 CONTRIBUTEUR C

**Mission :** ajouter `exporterCSV()` et `exporterJSON()` dans `Sondage.php`

⚠️ **Attendre que la PR du Contributeur B soit fusionnée avant de commencer.**

---

## ÉTAPE 1 — Cloner le dépôt GitHub

```bash
git clone https://github.com/<pseudo-mainteneur>/vote-php-central.git
cd vote-php-central

git config user.name "Votre Nom"
git config user.email "votre@email.com"
```

---

## ÉTAPE 2 — Synchroniser avec le main à jour

```bash
git fetch origin
git merge origin/main
```

---

## ÉTAPE 3 — Créer votre branche

```bash
git checkout -b feature/export
```

---

## ÉTAPE 4 — Ajouter votre code

Copier le fichier **`Sondage.php`** (du ZIP Contributeur-C) dans le dossier `vote-php-central`.

Vérifier :
```bash
dir
# Doit afficher : Sondage.php
```

---

## ÉTAPE 5 — Envoyer votre branche

```bash
git add Sondage.php
git commit -m "feat(export): exporterCSV() et exporterJSON() — export des résultats"
git push -u origin feature/export
```

---

## ÉTAPE 6 — Ouvrir la Pull Request sur GitHub

1. Aller sur **https://github.com/\<pseudo-mainteneur\>/vote-php-central**
2. Cliquer sur le bouton jaune **"Compare & pull request"**
3. Remplir le formulaire :
   - **Titre** : `feat(export): exporterCSV() et exporterJSON()`
   - **Description** : `Ajout de exporterCSV() et exporterJSON() pour sauvegarder les résultats du sondage dans des fichiers`
   - Vérifier : `feature/export → main`
4. Cliquer **"Create pull request"** ✅
5. Envoyer le lien de la PR au mainteneur

---

---

# RÉCAPITULATIF DES COMMANDES PAR RÔLE

## Mainteneur
```bash
mkdir vote-php-central && cd vote-php-central
git init
git config user.name "Votre Nom"
git config user.email "votre@email.com"
git add Sondage.php
git commit -m "feat: initialisation du projet — classe Sondage avec ajouterOption() et voter()"
git branch -M main
git remote add origin https://github.com/<votre-pseudo>/vote-php-central.git
git push -u origin main
```

## Contributeur A
```bash
git clone https://github.com/<pseudo-mainteneur>/vote-php-central.git
cd vote-php-central
git config user.name "Votre Nom"
git config user.email "votre@email.com"
git checkout -b feature/resultats
# → copier Sondage.php du ZIP dans ce dossier
git add Sondage.php
git commit -m "feat(resultats): afficherResultats() avec barres et pourcentages"
git push -u origin feature/resultats
```

## Contributeur B
```bash
git clone https://github.com/<pseudo-mainteneur>/vote-php-central.git
cd vote-php-central
git config user.name "Votre Nom"
git config user.email "votre@email.com"
git fetch origin && git merge origin/main
git checkout -b feature/cloture
# → copier Sondage.php du ZIP dans ce dossier
git add Sondage.php
git commit -m "feat(cloture): cloturerSondage() + estCloture() — verrouillage définitif"
git push -u origin feature/cloture
```

## Contributeur C
```bash
git clone https://github.com/<pseudo-mainteneur>/vote-php-central.git
cd vote-php-central
git config user.name "Votre Nom"
git config user.email "votre@email.com"
git fetch origin && git merge origin/main
git checkout -b feature/export
# → copier Sondage.php du ZIP dans ce dossier
git add Sondage.php
git commit -m "feat(export): exporterCSV() et exporterJSON() — export des résultats"
git push -u origin feature/export
```
