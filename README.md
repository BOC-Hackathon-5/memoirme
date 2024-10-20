### Flows

[Client] = C (o Sigkenis)
[Family & Friends] = FF
[Public] = P (Every one that can make payments)
[Memoir Me] = MM

* [MM] Jinius Integration pre existing client_id,client_secret
* [C] Logs in and adds his/her obituary
* [C] Add Payment Account from Bank Of Cyprus where he/she will receive donations.
* [C] can publish the Obituary to his/her social media all links will be redirected to [memoirme](https://memoirme.life)
* [FF] can add comments, condolences on the Obituary.
* [C] can invite [FF] as moderators of the public wall to allow condolences to be public or private.
* [P] can view the Obituary and Donate to the Family ()
* [MM] Donations will be split to the appropriate party

### Presentation

My Name is Lefteris Kameris
the Son of George Kameris 
the Son of Fillipos Kameris

Three things are certain in this world.

Taxes, Death, Judgement.

My focus today is Death.

Because death comes to us all.

Statistically speaking 100% die.

"Memoir Me" is a SaaS that helps families and individuals celebrate life of their loved ones through digital memoirs. 

The platform enables users to create personalized tributes that not only celebrate 
life but also serve as a tool for healing and remembrance.

How does it work.

1. Show the Customer Screen Wanting to create a memory.
2. Show the Public facing view where someone can initiate a payment
3. Show Admin for Remittance Api sending to Companies.



```json
{
"documentNumber": "V30001100001",
"issueDate": "2019-07-31T12:42:12Z",
"dueDate": "2019-08-30T12:42:12Z",
"issuerVatNumber": "12345678X",
"issuerTaxIdNumber": "12345679X",
// "issuerBusinessUnitId": "fcbf338c-3c8d-43ec-a802-55a9722f3dfb",
"recipientVatNumber": "12345677X",
"recipientTaxIdNumber": "12345677X",
// "recipientBusinessUnitId": "2ebebd8f-44c7-440c-98c1-b73810833fc4",
"description": "",
"orderReference": "0210001272",
"lineItems": [
{
	"code": "",
	"description": "LINE DESCRIPTION",
	"quantity": 1,
	"unit": "Kilos",
	"price": 100.1,
	"discountPercentage": 0,
	"taxPercentage": "NinePercent",
	"discount": 0,
	"lineTotal": 109.11,
	"taxAmount": 9.01
}
],
"discount": 0,
"net": 100.1,
"initial": 100.1,
"vatAmount": 9.01,
"totalAmount": 109.11
}

```

