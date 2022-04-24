package gabriel.AccountManager;

import gabriel.AccountManager.model.BankAccount;

public class Utils {
	
	private static boolean isNullOrEmpty(String str) {
        return str == null || str.equals("");
    }

    public static boolean isModelValid(BankAccount b) {
        return !isNullOrEmpty(b.getNom()) && !isNullOrEmpty(b.getPrenom()) && b.getAccount() >= 0.0 && b.getRisk() != null;
    }
}