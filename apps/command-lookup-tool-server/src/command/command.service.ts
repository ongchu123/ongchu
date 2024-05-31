import { Injectable } from "@nestjs/common";
import { PrismaService } from "../prisma/prisma.service";
import { CommandServiceBase } from "./base/command.service.base";

@Injectable()
export class CommandService extends CommandServiceBase {
  constructor(protected readonly prisma: PrismaService) {
    super(prisma);
  }
}
