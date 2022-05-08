package gabriel.AccountManager.model;

import com.googlecode.objectify.annotation.Entity;
import com.googlecode.objectify.annotation.Id;

@Entity
public class BankAccount {

    @Id
    private Long uuid;
    private String nom;
    private String prenom;
    private double account;
    private Risk risk;

    public BankAccount(Long uuid, String nom, String prenom, double account, Risk risk) {
        if (uuid != null){
            this.uuid = uuid;
        }
        this.nom = nom;
        this.prenom = prenom;
        this.account = account;
        this.risk = risk;
    }

    public BankAccount(){ }
    
    public String getNom() {
        return nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public double getAccount() {
        return account;
    }

    public Risk getRisk() {
        return risk;
    }

    public Long getUuid(){return uuid;}

    public void setModelValue(String nom, String prenom, double account, Risk risk) {
        this.nom = nom;
        this.prenom = prenom;
        this.account = account;
        this.risk = risk;
    }
}
