function mudarClassActive(liItem) {
    
    if (liItem == "liDashboard") {
        document.getElementById("liDashboard").className = "active treeview";
    } else {
        document.getElementById("liDashboard").className = "treeview";
    }
    
    if (liItem == "liAdministrativo") {
        document.getElementById("liAdministrativo").className = "active treeview";
    } else {
        document.getElementById("liAdministrativo").className = "treeview";
    }
    
    if (liItem == "liContabiliade") {
        document.getElementById("liContabiliade").className = "active treeview";
    } else {
        document.getElementById("liContabiliade").className = "treeview";
    }
}