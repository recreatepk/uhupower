<?
class Dashboard_model extends CI_Model {

	public function Get_newses(){
		return $this->db->order_by('news_id','DESC')->get('news')->result_array();
	}

	public function Get_monthly_purchase_sum(){
		
		return $this->db->query("SELECT SUM(purchase_order_product_cost*purchase_order_product_qty) as sum
								FROM purchase_order
								JOIN purchase_order_product ON purchase_order_product.purchase_order_id = purchase_order.purchase_order_id
								WHERE purchase_order_status = '2'
								AND MONTH(purchase_order_date) = MONTH(CURRENT_DATE())
								AND YEAR(purchase_order_date) = YEAR(CURRENT_DATE());")
						->result_array();
	}
	public function Get_last_month_purchase_sum() {
	    return $this->db->query("SELECT SUM(purchase_order_product_cost)
	                            FROM purchase_order
	                            JOIN purchase_order_product ON purchase_order_product.purchase_order_id = purchase_order.purchase_order_id
	                            WHERE purchase_order_status = '2'
	                            AND MONTH(purchase_order_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
	                            AND YEAR(purchase_order_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH);")
	                    ->result_array();
	}


	public function Get_monthly_sale_sum(){
		return $this->db->query("SELECT SUM(invoice_cost*invoice_qty) as sum
								FROM invoice
								JOIN invoice_product ON invoice_product.invoice_id = invoice.invoice_id
								WHERE invoice_status = '3'
								AND MONTH(invoice_date) = MONTH(CURRENT_DATE())
								AND YEAR(invoice_date) = YEAR(CURRENT_DATE());")
						->result_array();
	}
	public function Get_last_month_sale_sum() {

	    return $this->db->query("SELECT SUM(invoice_cost)
	                            FROM invoice
	                            JOIN invoice_product ON invoice_product.invoice_id = invoice.invoice_id
	                            WHERE invoice_status = '3'
	                            AND MONTH(invoice_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
	                            AND YEAR(invoice_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH);")
	                    ->result_array();
	}

	public function Get_current_month_invoice_count() {
	    return $this->db->query("SELECT COUNT(invoice_id)
								FROM invoice
								WHERE invoice_status = '3'
								AND MONTH(invoice_date) = MONTH(CURRENT_DATE())
								AND YEAR(invoice_date) = YEAR(CURRENT_DATE());
								")
	                    ->result_array();
	}
	public function Get_last_month_invoice_count() {
	    return $this->db->query("SELECT COUNT(invoice_id)
								FROM invoice
								WHERE invoice_status = '3'
								AND MONTH(invoice_date) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)
								AND YEAR(invoice_date) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH);")
	                    ->result_array();
	}
	public function Get_yearly_sales_sums(){
		return $this->db->query("SELECT
								    DATE_FORMAT(i.invoice_date, '%Y-%m') AS month,
								    SUM(ip.invoice_cost * ip.invoice_qty) AS total_cost
								FROM
								    invoice_product ip
								JOIN
								    invoice i ON ip.invoice_id = i.invoice_id
								WHERE
								    YEAR(i.invoice_date) = YEAR(CURRENT_DATE()) -- Filter for the current year
								    AND
								    i.invoice_status = 3
								GROUP BY
								    DATE_FORMAT(i.invoice_date, '%Y-%m')
								ORDER BY
								    month;")
						->result_array();
	}

	public function Get_yearly_expense_sums(){
		return $this->db->query("SELECT
								    DATE_FORMAT(expense_date, '%Y-%m') AS month,
								    SUM(expense_cost) AS total_expenses
								FROM
								    expense
								WHERE
								    YEAR(expense_date) = YEAR(CURRENT_DATE()) -- Filter for the current year
								GROUP BY
								    DATE_FORMAT(expense_date, '%Y-%m')
								ORDER BY
								    month;
								")
						->result_array();
	}

	public function Get_yearly_purchase_sums(){
		return $this->db->query("SELECT
								    DATE_FORMAT(po.purchase_order_date, '%Y-%m') AS month,
								    SUM(
								        pop.purchase_order_product_cost * pop.purchase_order_product_qty
								    ) AS total_cost
								FROM
								    purchase_order_product pop
								JOIN purchase_order po ON
								    pop.purchase_order_id = po.purchase_order_id
								WHERE
								    YEAR(po.purchase_order_date) = YEAR(CURRENT_DATE()) -- Filter for the current year 
								    AND po.purchase_order_status = 2
								GROUP BY
								    DATE_FORMAT(po.purchase_order_date, '%Y-%m')
								ORDER BY
								    month;")
						->result_array();
	}




	
}