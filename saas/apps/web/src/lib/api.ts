export const API_BASE_URL =
  process.env.NEXT_PUBLIC_API_URL ||
  (process.env.NEXT_PUBLIC_DEPLOYMENT_ENV === 'production'
    ? 'https://api.bodeshop-saas.vercel.app'
    : 'http://localhost:4000');

export async function apiFetch<T>(
  endpoint: string,
  options: RequestInit & { token?: string; tenantId?: string; branchId?: string } = {}
): Promise<T> {
  const { token, tenantId, branchId, headers = {}, ...rest } = options;

  const reqHeaders: Record<string, string> = {
    'Content-Type': 'application/json',
    ...(headers as Record<string, string>),
  };

  if (token) {
    reqHeaders['Authorization'] = `Bearer ${token}`;
  }

  if (tenantId) {
    reqHeaders['x-tenant-id'] = tenantId;
  }

  if (branchId) {
    reqHeaders['x-branch-id'] = branchId;
  }

  const res = await fetch(`${API_BASE_URL}${endpoint}`, {
    headers: reqHeaders,
    ...rest,
  });

  if (!res.ok) {
    const errorBody = await res.json().catch(() => ({}));
    throw new Error(errorBody.message || `Error en petición: ${res.statusText}`);
  }

  return res.json();
}
