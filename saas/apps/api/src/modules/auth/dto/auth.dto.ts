import { IsEmail, IsNotEmpty, IsString, MinLength } from 'class-validator';

export class LoginDto {
  @IsEmail({}, { message: 'El correo electrónico no es válido' })
  email: string;

  @IsNotEmpty({ message: 'La contraseña es requerida' })
  @MinLength(6, { message: 'La contraseña debe tener al menos 6 caracteres' })
  password: string;

  @IsNotEmpty({ message: 'El identificador de empresa (slug) es requerido' })
  @IsString()
  tenantSlug: string;
}

export class RegisterTenantDto {
  @IsNotEmpty({ message: 'El nombre legal de la empresa es requerido' })
  @IsString()
  legalName: string;

  @IsNotEmpty({ message: 'El nombre comercial de la empresa es requerido' })
  @IsString()
  tradeName: string;

  @IsNotEmpty({ message: 'El subdominio o slug es requerido' })
  @IsString()
  slug: string;

  @IsNotEmpty({ message: 'El número de identificación fiscal (RIF/NIT/RUT) es requerido' })
  @IsString()
  taxId: string;

  @IsEmail({}, { message: 'El correo electrónico no es válido' })
  email: string;

  @IsNotEmpty({ message: 'La contraseña es requerida' })
  @MinLength(8, { message: 'La contraseña debe tener al menos 8 caracteres' })
  password: string;

  @IsNotEmpty({ message: 'El nombre del administrador es requerido' })
  @IsString()
  adminFirstName: string;

  @IsNotEmpty({ message: 'El apellido del administrador es requerido' })
  @IsString()
  adminLastName: string;
}
