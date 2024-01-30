
const API_URL = 'http://localhost:8000/clients.php';


export async function getClients() {
    const res = await fetch(API_URL);
    return res.json();    
}

export async function getClient(id : string) {
    const res = await fetch(`${API_URL}?id=${id}`);
    return res.json();    
}

export async function editClient(id: string, data: any) {
    const res = await fetch(`${API_URL}?id=${id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    });
    return res.json();
  }
