export default {
	tabs: {
		"Renewables": {
			UNIT_TRUST: {
				insurance_type: '1',
				title: 'Unit Trust'
			},
			STRUCTURED_DEPOSIT: {
				insurance_type: '2',
				title: 'Structured Deposit'
			},
			STOCKS: {
				insurance_type: '3',
				title: 'Stocks'
			},
			STRUCTURED_NOTES: {
				insurance_type: '4',
				title: 'Structured Notes'
			},
			CORPORATE_BONDS: {
				insurance_type: '5',
				title: 'Corporate Bonds'
			},
			RETAILS_BONDS: {
				insurance_type: '6',
				title: 'Retails Bonds'
			},
			ETF: {
				insurance_type: '7',
				title: 'ETF'
			},
			HEDGED_FUNDS: {
				insurance_type: '8',
				title: 'Hedged Funds'
			}	,
			OTHERS: {
				insurance_type: '9',
				title: 'Others'
			}		
		}
	},
	formFields: [
		{
			key: 'custodian_account',
			title: 'Custodian Account',
			type: 'text',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'type_of_account',
			title: 'Single/Jointly owned',
			type: 'select',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			options: [
				{
					text: 'Single',
					value: 'S'
				},
				{
					text: 'Jointly owned',
					value: 'J'
				}
			],
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'name_of_product',
			title: 'Name of Product',
			type: 'text',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'mode_of_payment',
			title: 'Mode of payment',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: 'Regular(Monthly)',
					value: 'MNT'
				},
				{
					text: 'Regular(Annual)',
					value: 'ANL'
				},
				{
					text: 'Lumpsum',
					value: 'LPS'
				}
			],
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'by',
			title: 'By',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: 'By Cash',
					value: 'CASH'
				},
				{
					text: 'CPF OA',
					value: 'CPF OA'
				},
				{
					text: 'CPF SA',
					value: 'CPF SA'
				},
				{
					text: 'SRS',
					value: 'SRS'
				}
			],
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'principal_paid',
			title: 'Investment Outlay (Including fees & Charges)',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'amount_invested',
			title: 'Amount Invested',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},		
		{
			key: 'trade_date',
			title: 'Trade Date',
			type: 'date',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'tenure',
			title: 'Tenure(If Any)',
			type: 'number',
			default: '',
			required: false,
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'maturity_date',
			title: 'Maturity date(If Any)',
			type: 'showText',
			readonly: true,
			required: false,
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'coupon_dividend_amount',
			title: 'Coupon/Dividends Amount (If Any)',
			type: 'priceNumber',
			required: false,
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'ams',
			title: 'Anuual/Semi/Monthly',
			type: 'select',
			default: '',
			class: '',
			options: [
				{
					text: 'Monthly',
					value: 'MNT'
				},
				{
					text: 'Semi Annual',
					value: 'SEM'
				},
				{
					text: 'Annual',
					value: 'ANL'
				}
			],
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'coupon_dividend',
			title: 'Coupon/ Dividends (%)',
			type: 'number',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'yield_to_maturity',
			title: 'Estimated Yield to Maturity ($)',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'current_market_value',
			title: 'Current Market Value',
			type: 'priceNumber',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		
		{
			key: 'remarks',
			title: 'Remarks',
			type: 'textarea',
			default: '',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'managed_by',
			title: 'Managed By Self',
			type: 'checkbox',
			default: '1',
			class: '',
			show_in: {
				table: false,
				fields: true
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		},
		{
			key: 'action',
			title: 'Actions',
			type: 'link',
			default: '',
			class: '',
			show_in: {
				table: true,
				fields: false
			},
			tab: {
				UNIT_TRUST: true,
				STRUCTURED_DEPOSIT: true,
				STOCKS: true,
				STRUCTURED_NOTES: true,
				CORPORATE_BONDS: true,
				RETAILS_BONDS: true,
				ETF: true,
				HEDGED_FUNDS: true,
				OTHERS: true
			}
		}
	]
}