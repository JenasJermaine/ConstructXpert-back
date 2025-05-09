<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Query 1: Materials Availability Report
     */
    public function materialsAvailability()
    {
        $query = "
            SELECT 
                Materials.MaterialName, 
                [Total Materials Bought].TotalQuantityBought, 
                [Total Materials Used].TotalQuantityUsed, 
                ([Total Materials Bought].TotalQuantityBought - [Total Materials Used].TotalQuantityUsed) AS AvailableQuantity
            FROM Materials 
            INNER JOIN [Total Materials Bought] ON Materials.MaterialID = [Total Materials Bought].MaterialID 
            INNER JOIN [Total Materials Used] ON Materials.MaterialID = [Total Materials Used].MaterialID
        ";

        // Directly call DB::select with the SQL string.
        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 2: Client Payments Report
     */
    public function clientPaymentsReport()
    {
        $query = "
            SELECT 
                Clients.Name, 
                Projects.ProjectName, 
                SUM(ClientPayments.Amount) AS TotalPaid
            FROM Clients 
            INNER JOIN Projects ON Clients.ClientID = Projects.ClientID 
            INNER JOIN ClientPayments ON Projects.ProjectID = ClientPayments.ProjectID
            GROUP BY Clients.Name, Projects.ProjectName
        ";

        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 3: Equipment Earnings Report
     *
     * Note: Changed DateDiff syntax to T-SQL DATEDIFF.
     */
    public function equipmentEarningsReport()
    {
        $query = "
            SELECT 
                Equipment.EquipmentName, 
                EquipmentAssignments.StartDate, 
                EquipmentAssignments.EndDate, 
                DATEDIFF(day, EquipmentAssignments.StartDate, EquipmentAssignments.EndDate) AS DaysUsed, 
                Equipment.RentalRate, 
                DATEDIFF(day, EquipmentAssignments.StartDate, EquipmentAssignments.EndDate) * Equipment.RentalRate AS TotalEarned
            FROM Equipment 
            INNER JOIN EquipmentAssignments ON Equipment.EquipmentID = EquipmentAssignments.EquipmentID
            GROUP BY Equipment.EquipmentName, EquipmentAssignments.StartDate, EquipmentAssignments.EndDate, Equipment.RentalRate
        ";

        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 4: Project Materials Used Report
     */
    public function projectMaterialsUsedReport()
    {
        $query = "
            SELECT 
                Projects.ProjectName, 
                Materials.MaterialName, 
                SUM(ProjectMaterials.QuantityUsed) AS TotalUsed
            FROM Projects 
            INNER JOIN ProjectMaterials ON Projects.ProjectID = ProjectMaterials.ProjectID
            INNER JOIN Materials ON Materials.MaterialID = ProjectMaterials.MaterialID
            GROUP BY Projects.ProjectName, Materials.MaterialName
        ";

        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 5: Personnel Salaries Report
     *
     * Ensure the Personnel table column name is correct; changed 'PersonelID' to 'PersonnelID' if necessary.
     */
    public function personnelSalariesReport()
    {
        $query = "
            SELECT 
                Personnel.Name, 
                Personnel.Salary, 
                PersonnelSalaries.PaymentPeriod
            FROM Personnel 
            INNER JOIN PersonnelSalaries ON Personnel.PersonnelID = PersonnelSalaries.PersonnelID
        ";

        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 6: Unpaid Material Purchases Report
     */
    public function unpaidMaterialPurchasesReport()
    {
        $query = "
            SELECT 
                Suppliers.SupplierName, 
                MaterialPurchases.TotalCost, 
                MaterialPurchases.PurchaseDate, 
                MaterialPurchases.PaymentStatus
            FROM Suppliers 
            INNER JOIN MaterialPurchases ON Suppliers.SupplierID = MaterialPurchases.SupplierID
            WHERE MaterialPurchases.PaymentStatus = 'Unpaid'
        ";

        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 7: Total Material Cost Report
     */
    public function totalMaterialCostReport()
    {
        $query = "
            SELECT 
                SUM(MaterialPurchases.TotalCost) AS TotalCostOfMaterials
            FROM Materials 
            INNER JOIN MaterialPurchases ON Materials.MaterialID = MaterialPurchases.MaterialID
        ";

        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 8: Total Rental Income Report
     *
     * Note: This query assumes there is a view or table called [Earnings From  Equipment Renting].
     */
    public function totalRentalIncomeReport()
    {
        $query = "
            SELECT 
                SUM([Earnings From  Equipment Renting].TotalEarned) AS TotalRentalIncome
            FROM [Earnings From  Equipment Renting]
        ";

        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 9: Total Quantity Bought Report
     */
    public function totalQuantityBoughtReport()
    {
        $query = "
            SELECT 
                Materials.MaterialID, 
                Materials.MaterialName, 
                SUM(MaterialPurchases.Quantity) AS TotalQuantityBought
            FROM Materials 
            INNER JOIN MaterialPurchases ON Materials.MaterialID = MaterialPurchases.MaterialID
            GROUP BY Materials.MaterialID, Materials.MaterialName
        ";

        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 10: Total Quantity Used Report
     */
    public function totalQuantityUsedReport()
    {
        $query = "
            SELECT 
                Materials.MaterialID, 
                Materials.MaterialName, 
                SUM(ProjectMaterials.QuantityUsed) AS TotalQuantityUsed
            FROM Materials 
            INNER JOIN ProjectMaterials ON Materials.MaterialID = ProjectMaterials.MaterialID
            GROUP BY Materials.MaterialID, Materials.MaterialName
        ";

        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 11: Net Earnings Report
     *
     * Assumes existence of views or tables:
     * [Total Client Payments], [Total Wages Paid], [Total Cost of Materials], 
     * [Total Salaries Paid], and [Total Earnings From Equipments Renting].
     */
    public function netEarningsReport()
    {
        $query = "
            SELECT 
                [Total Client Payments].TotalClientPayments, 
                [Total Earnings From Equipments Renting_1].TotalRentalIncome, 
                [Total Cost of Materials].TotalCostOfMaterials, 
                [Total Wages Paid].TotalWagesPaid, 
                [Total Salaries Paid].TotalSalariesPaid, 
                ([TotalClientPayments] + [TotalRentalIncome]) - ([TotalCostOfMaterials] + [TotalWagesPaid] + [TotalSalariesPaid]) AS TotalNetEarnings
            FROM 
                [Total Client Payments], 
                [Total Wages Paid], 
                [Total Cost of Materials], 
                [Total Salaries Paid], 
                [Total Earnings From Equipments Renting] AS [Total Earnings From Equipments Renting_1]
        ";
    
        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 12: Total Salaries Paid Report
     *
     * Assumes existence of a view or table named [Monthly Personnel Salaries].
     */
    public function totalSalariesPaidReport()
    {
        $query = "
            SELECT 
                SUM([Monthly Personnel Salaries].Salary) AS TotalSalariesPaid
            FROM [Monthly Personnel Salaries]
        ";

        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 13: Total Wages Paid Report
     *
     * Assumes existence of a view or table named [Weekly Laborer Wages Calculation].
     */
    public function totalWagesPaidReport()
    {
        $query = "
            SELECT 
                SUM([Weekly Laborer Wages Calculation].CalcultedWage) AS TotalWagesPaid
            FROM [Weekly Laborer Wages Calculation]
        ";

        $results = DB::select($query);
        return response()->json($results);
    }

    /**
     * Query 14: Laborer Wages Calculation Report
     *
     * Note: Adjust the join if necessary; ensure column names are consistent.
     */
    public function laborerWagesCalculationReport()
    {
        $query = "
            SELECT 
                Personnel.Name, 
                LaborerWages.HoursWorked, 
                Personnel.HourlyRate, 
                LaborerWages.HoursWorked * Personnel.HourlyRate AS CalculatedWage
            FROM Personnel 
            INNER JOIN LaborerWages ON Personnel.PersonnelID = LaborerWages.PersonnelID
        ";

        $results = DB::select($query);
        return response()->json($results);
    }
}
