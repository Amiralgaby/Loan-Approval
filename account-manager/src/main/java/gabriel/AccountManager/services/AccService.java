package gabriel.AccountManager.services;

import com.googlecode.objectify.NotFoundException;
import gabriel.AccountManager.model.BankAccount;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

import static com.googlecode.objectify.ObjectifyService.ofy;

@Service
public class AccService {
    public List<BankAccount> getBankAccounts() {
        return ofy().load().type(BankAccount.class).list();
    }
    public void addBankAccount(BankAccount employee) {
        ofy().save().entity(employee).now();
    }

    public Optional<BankAccount> searchFirstByName(String name){
        return getBankAccounts().stream().filter(bankAccount -> bankAccount.getNom() != null && bankAccount.getNom().equals(name)).findFirst();
    }

    public Optional<BankAccount> getById(Long id){
        try{
            BankAccount bankAccount = ofy().load().type(BankAccount.class).id(id).safe();
            return Optional.of(bankAccount);
        }catch (NotFoundException notFoundException){
            return Optional.empty();
        }
    }

    public boolean deleteBankAccount(Long id) {
        try{
            var bankAccount = ofy().load().type(BankAccount.class).id(id).safe();
            ofy().delete().entity(bankAccount);
            return true;
        }catch (NotFoundException notFoundException){
            return false;
        }
    }

    public boolean deleteBankAccount(String name) {
        Optional<BankAccount> bankAccountOptional = searchFirstByName(name);
        if (bankAccountOptional.isEmpty()) {
            return false;
        }
        ofy().delete().entity(bankAccountOptional.get());
        return true;
    }
}
